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
        $query = 'SELECT * FROM product_summaries WHERE sku = :sku';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':sku', implode(',', $sku));
        $stmt->execute();
        $result = $stmt->fetch();
       // $product=[];
        if (!$result) {
            header('Content-Type: application/json');
           // echo json_encode($result);
            return jsonResponse(['error' => 'Product not found'], 404);
        }

        $product = [
            'product_id' => $result['product_id'],
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

    $allProduct = Allproduct::create([
        'sku' => request('sku'),
        'name' => request('name'),
        'price' => request('price'),
        'type' => request('type'),
    ]);

   // $product_id = $allProduct->id;

    if (request('type') === 'book') {
        $validator->setRules([
            'weight' => 'required',
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
        } elseif (request('type') === 'dvd') {
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
    } elseif (request('type') === 'furniture') {
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
    }

    app()->session->setFlash('success', 'Product Created successfully :D');
    return back();
}

    
    public function massDelete()
    {

     $productIds =$_POST['productIds'];

        foreach ($productIds as $id ) {
            //DELETING product special attr from BOOKS table
        if($type == 'book'){
            $query = "DELETE FROM books WHERE product_id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $query = "DELETE FROM products WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id);

       $stmt->execute();
        } elseif($type == 'dvd'){
            $query = "DELETE FROM dvds WHERE product_id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id);    
            $stmt->execute();

            $query = "DELETE FROM products WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id);

            $stmt->execute();
     
        } elseif($type == 'furniture'){
            $query = "DELETE FROM furnitures WHERE product_id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id);
     
            $stmt->execute();
              $query = "DELETE FROM products WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id);

            $stmt->execute();
        }
        }
       $response =[
        'message'=>'Product deleted successfully',
        'status'=> 200
       ];  
   
    }

}