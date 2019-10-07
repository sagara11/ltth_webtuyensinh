<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Elasticsearch\ClientBuilder;
require_once 'C:/xampp/htdocs/webtuyensinh/vendor/autoload.php';

class ElasticsearchController extends Controller
{
	public static $connect;
	public static $client;

    public function connect()
    {
        $hosts = [
		    '127.0.0.1:9200',         // IP + Port
		];
		self::$client = ClientBuilder::create()           // Instantiate a new ClientBuilder
		                    ->setHosts($hosts)      // Set the hosts
		                    ->build();
		
		self::$connect =  mysqli_connect('localhost', 'root', '', 'baotuyensinh');
		mysqli_set_charset(self::$connect, 'UTF8');

		if (mysqli_connect_error())
		{
	    	die("Connection failed: " . mysqli_connect_error());
		}
	}
	public function disconnect()
	{
		self::$connect->close();
	}
    public function init()
    {
        $this->connect();
        $sql = "SELECT * FROM posts";

		$result = mysqli_query(self::$connect,$sql);

		if (mysqli_num_rows($result) > 0)
		{
		    while($row = mysqli_fetch_assoc($result))
		    {
		        $params = [
				    'index' => 'baotuyensinh',
				    'type' => 'posts',
				    'id' => $row["id"],
					'body' => [
						'image' =>$row["image"],
						'name' => $row["name"],
						'description' =>$row["description"],
						'content' =>$row["content"],
						'publish'=>$row["publish"],
						'updated_at'=>$row["updated_at"]
					]
				];
				self::$client->index($params);
			}
		}
		else
		{
		    echo "0 results";
		}
		$this->disconnect();
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create($id,$image,$name,$description,$publish,$updated_at)
    {
        $this->connect();
        if($name != '' && $description != '')
        {
		        $params = [
				    'index' => 'baotuyensinh',
				    'type' => 'posts',
				    'id' => $id,
					'body' => [
						'id' => $id,
						'image' =>$image,
						'name' => $name,
						'description' =>$description,
						'publish'=>$publish,
						'updated_at'=>$updated_at
					]
				];
		    self::$client->index($params);
		}
		else
		{
		    echo "0 results";
		}
		$this->disconnect();
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function upload($book,$id,$image,$name,$description,$publish,$updated_at)
    {
    	if($name != '' && $description != '')
        {
    		$this->connect();
		    $params = [
		    'index' => 'baotuyensinh',
		    'type' => 'posts',
		    'id'    => $book,
		    'body'  => [
		        'doc' => [
		        	'id' => $id,
		            'image' =>$image,
					'name' => $name,
					'description' =>$description,
					'publish'=>$publish,
					'updated_at'=>$updated_at
			        ]
			    ]
			];
		self::$client->update($params);
		}
		else
		{
			echo "upload fail!!!";
		}
		$this->disconnect();
    }
    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
    	$this->connect();
       $params = [
	    'index' => 'baotuyensinh',
	    'type' => 'posts',
	    'id'    => $id
		];
		$response = self::$client->delete($params);
		return;
		$this->disconnect();
    }
    public function search($data)
    {
    	$this->connect();
    	$params = [
    		'index' => 'baotuyensinh',
    		'type'  => 'posts',
	    	"body" => [
	    		"size" => 8,
	    		"from" => 0,
	        	"query" => [
	           		"multi_match" => [
	           			"query" => $data,
	           			// "fields" => ['name'],
	           		]
	       		]
	   		]
		];
		$results = self::$client->search($params);
		 if($results['hits']['total'] >= 1)
		{
			$query = $results['hits']['hits'];
			$i=0;
			foreach ($query as $row) {
				$user[] = $query[$i]['_source'];
				$i++;
			}
		}
		return $user;
		$this->disconnect();	
    }
    public function activate($id,$publish)
    {
    	if($publish != '')
        {
    		$this->connect();
		    $params = [
		    'index' => 'baotuyensinh',
		    'type' => 'posts',
		    'id'    => $id,
		    'body'  => [
		        'doc' => [
					'publish'=>$publish,
			        ]
			    ]
			];
		$response = self::$client->update($params);
		}
		else
		{
			echo "activate fail!!!";
		}
		return;
    }
    public function trend($id,$trend)
    {
    	if($trend != '')
        {
    		$this->connect();
		    $params = [
		    'index' => 'baotuyensinh',
		    'type' => 'posts',
		    'id'    => $id,
		    'body'  => [
		        'doc' => [
					'trend'=>$trend,
			        ]
			    ]
			];
		$response = self::$client->update($params);
		}
		else
		{
			echo "Change fail!!!";
		}
		return;
    }
}
