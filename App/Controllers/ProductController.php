<?php

namespace App\Controllers;
use App\Models\Allproduct;
use App\Models\Book;
use App\Models\Dvd;
use App\Models\Furniture;
use TestTask\Validation\Validator;
use TestTask\Database\Managers\MySQLManager;
use TestTask\Http\Request;
use TestTask\Http\Response;
use TestTask\Database\DB;
//use TestTask\View\View;


class ProductController extends Controller
{
    private $pdo;

    public function __construct()
    {
        $this->connectDb();
    }


    public function connectDb()
    {
        $mySQLManager = new MySQLManager();
        $this->pdo = $mySQLManager->connect();
    }
     
    public function getProductBySku($sku) {

        $sku=[];
        $query = 'SELECT * FROM product_summaries WHERE sku = :sku';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':sku', $sku);
        $stmt->execute();
        $result = $stmt->fetch();
    
        if (!$result) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    
        $product = [
            'sku' => $result['sku'],
            'name' => $result['name'],
            'price' => $result['price'],
            'type' => $result['type'],
            'weight' => $result['weight'],
            'size' => $result['size'],
            'height' => $result['height'],
            'width' => $result['width'],
            'length' => $result['length'],
            'details' => $result['details'],
            'details_title' => $result['details_title'],
        ];
    
        header('Content-Type: application/json');
        echo json_encode($product);
       return jsonResponse($product);
    }
  
    public function index()
    {

        $query = 'SELECT * FROM product_summaries';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll();

        $products = array();
        foreach ($results as $row) {
            $products[] = array(
                'sku' => $row['sku'],
                'name' => $row['name'],
                'price' => $row['price'],
                'type' => $row['type'],
                'weight' => $row['weight'],
                'size' => $row['size'],
                'height' => $row['height'],
                'width' => $row['width'],
                'length' => $row['length'],
                'details' => $row['details'],
                'details_title' => $row['details_title'],
            );
        }

       // header('Content-Type: application/json');
        // echo json_encode($products);
       // return jsonResponse($products);
       return view('product.index', ['products' => $products]);
  
     
    }
   
 

    public function create()
    {
       
        //var_dump("yess");
        return view('product.create');
    }

    public function store()
    {
        $validator = new Validator();
      
        $validator->setRules([
            'sku' => 'required|unique:allproducts,sku',
            'name' => 'required|unique:allproducts,name',
            'price' => 'required',
            'type' => 'required',
        
        ]);
    
        $validator->make(request()->all());
    
        if (!$validator->passes()) {
            app()->session->setFlash('errors', $validator->errors());
            app()->session->setFlash('old', request()->all());
    
            return back();
        }
    
        $product = Allproduct::create([
            'id' => request('id'),
            'sku' => request('sku'),
            'name' => request('name'),
            'price' => request('price'),
            'type' => request('type'),
        ]);
         
        $validator->setRules([
        
            'weight' => 'required'
        
        ]);
    
        $validator->make(request()->all());
    
        if (!$validator->passes()) {
            app()->session->setFlash('errors', $validator->errors());
            app()->session->setFlash('old', request()->all());
    
            return back();
        }
         Book::create([          
            'product_id' =>$this->pdo->lastInsertId(),
            'weight' => request('weight'),        
        ]);


        $validator->setRules([       
            'size' => 'required',        
        ]);
    
        $validator->make(request()->all());
    
        if (!$validator->passes()) {
            app()->session->setFlash('errors', $validator->errors());
            app()->session->setFlash('old', request()->all());
    
            return back();
        }
        Dvd::create([
           
            'product_id' =>$this->pdo->lastInsertId(),
            'size' => request('size'),
         
        ]);
        $validator->setRules([
        
            'height' => 'required',
            'width' => 'required',
            'length' => 'required',
        
        ]);
    
        $validator->make(request()->all());
    
        if (!$validator->passes()) {
            app()->session->setFlash('errors', $validator->errors());
            app()->session->setFlash('old', request()->all());
    
            return back();
        }
        Furniture::create([
           
            'product_id' =>$this->pdo->lastInsertId(),
            'height' => request('height'),
            'width' => request('width'),
            'length' => request('length'),
         
        ]);
    
        app()->session->setFlash('success', 'Product Created successfully :D');
        return back();
    }
    



    // public function delete($id) {
    //     $product = Allproduct::find($id);
    //     if ($product) {
    //         $product->delete();
    //         return redirect('/product')->with('success', 'Product deleted successfully');
    //     }
    //     return redirect('/product')->with('error', 'Product not found');
    // }


    // public function insertProduct(Request $request)
    // {
    //     // Validate the data received from the request


    //     // Insert data into the master table
    //     Allproduct::create([
    //         'sku' => $request->input('sku'),
    //         'name' => $request->input('name'),
    //         'price' => $request->input('price'),
    //         'type' => $request->input('type'),
    //     ]);

    //     // Insert data into detail table 1
    //     Book::create([
    //         'weight' => $request->input('weight'),
    //     ]);

    //     // Insert data into detail table 2
    //     Dvd::create([
    //         'size' => $request->input('size'),
    //     ]);

    //     // Insert data into detail table 3
    //     Furniture::create([
    //         'height' => $request->input('height'),
    //         'width' => $request->input('width'),
    //         'length' => $request->input('length'),
    //     ]);

    //     // Return a success response
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Product inserted successfully',
    //     ]);
    // }

    //  function insertProduct($sku, $name, $price, $type, $details) {
    //     // Establish a database connection
    //   //  $pdo = new PDO("mysql:host=localhost;dbname=mydatabase", "username", "password");
      
    //     // Validate the input data (e.g., check for empty fields)
      
    //     // Define the SQL statement for inserting data into the allproducts table
    //     $sql_allproducts = "INSERT INTO allproducts (sku, name, price) VALUES (?, ?, ?)";
      
    //     // Begin a transaction
    //     $pdo->beginTransaction();
      
    //     try {
    //       // Insert data into the allproducts table
    //       $stmt_allproducts = $this->pdo->prepare($sql_allproducts);
    //       $stmt_allproducts->execute([$sku, $name, $price]);
      
    //       // Retrieve the ID of the newly inserted row
    //       $allproducts_id = $this->pdo->lastInsertId();
      
    //       // Define the SQL statement for inserting data into the type-specific table
    //       $sql_specific = "INSERT INTO $type (product_id";
    //       $values = [$allproducts_id];
      
    //       // Get the column names and values for the type-specific table
    //       foreach ($details as $key => $value) {
    //         $sql_specific .= ", $key";
    //         $values[] = $value;
    //       }
    //       $sql_specific .= ") VALUES (?" . str_repeat(", ?", count($values) - 1) . ")";
      
    //       // Insert data into the appropriate type-specific table
    //       $stmt_specific = $this->pdo->prepare($sql_specific);
    //       $stmt_specific->execute($values);
      
    //       // Commit the transaction
    //       $pdo->commit();
    //     } catch (PDOException $e) {
    //       // Roll back the transaction on error
    //       $pdo->rollBack();
    //       // Handle the error (e.g., log it, display a user-friendly message)
    //       return false;
    //     }
      
    //     // Close the database connection
    //     $pdo = null;
      
    //     return true;
    //   }
      
    public function massDelete()
    {
        // Retrieve the list of product IDs from the request body
        $productIds = $_POST['productIds'];
    
        // Call a delete method on the Product model to delete the products
        $result = Allproduct::deleteByIds($productIds);
    
        // Return a JSON response indicating whether the delete operation was successful or not
        if ($result) {
            return json_encode(['message' => 'Products deleted successfully', 'status' => 200]);
        } else {
            return json_encode(['message' => 'Failed to delete products', 'status' => 500]);
        }
    }
    
   
}

