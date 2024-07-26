<?php
namespace CSY2028;
class DatabaseTable {
	private $pdo;
	private $table;
	private $primaryKey;

	/*All functions, unless otherwise noted, are drawn from the JokeSite that Dr. Tom Butler provided in his lectures. 
*/
	/*The three self-created functions are lastinsertID, which is used when adding photographs to the site, findallDESC, which is used on the news page, and the paginaton function, which was intended to be used to enhance site readability. 
 */

	public function __construct($pdo, $table, $primaryKey) {
		$this->pdo = $pdo;
		$this->table = $table;
		$this->primaryKey = $primaryKey;
	}
    public function delete($id) {
		$stmt = $this->pdo->prepare('DELETE FROM ' . $this->table . ' WHERE ' . $this->primaryKey . ' = :id');
		$criteria = [
			'id' => $id
		];
		$stmt->execute($criteria);
	}

    public function insert($record) {
        $keys = array_keys($record);

        $values = implode(',', $keys);
        $valuesWithColon = implode(',:', $keys);

        $query = 'INSERT INTO ' . $this->table . '('.$values.') VALUES (:'.$valuesWithColon.')';

        $stmt = $this->pdo->prepare($query);

        $stmt->execute($record);
	}

	public function find($field, $value) {
		$stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = :value');

		$criteria = [
			'value' => $value
		];
		$stmt->execute($criteria);

		return $stmt->fetchAll();
	}

	/*I created a new function that, like the original find all method below, retrieves all the entries from a table and returns all the results in descending order. This function is used in news stories to display the most recent story at the top.
 */
	public function findAllDESC($order) {
		$stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' ORDER BY '. $order . ' DESC');

		$stmt->execute();

		return $stmt->fetchAll();
	}

	public function findAll() {
		$stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table);

		$stmt->execute();

		return $stmt->fetchAll();
	}


	public function save($record) {
		try {
			$this->insert($record);
		}
		catch (\Exception $e) {
			$this->update($record);
		}
	}

	public function update($record) {

	         $query = 'UPDATE ' . $this->table . ' SET ';

	         $parameters = [];
	         foreach ($record as $key => $value) {
	                $parameters[] = $key . '= :' .$key;
	         	}

	         $query .= implode(',', $parameters);
	         $query .= ' WHERE ' . $this->primaryKey . ' = :primaryKey';

	         $record['primaryKey'] = $record[$this->primaryKey];

	         $stmt = $this->pdo->prepare($query);

	         $stmt->execute($record);
	}

	/*This feature, which is now inactive, initiates a general function for page numbers to improve the usability of the website.
 */
	public function pagination() {
		$recordsOnPage = 5; 
		$totalRecords = $this->pdo->prepare('SELECT COUNT(*) FROM ' . $this->table);
		$totalRecords->execute();
		$numberOfPage = CEIL($totalRecords / $recordsOnPage);

		if (!isset ($_GET['page']) ) {  
			$page = 1;  
		} else {  
			$page = $_GET['page'];  
		}  

		$limit = ($page-1) * $recordsOnPage; 
		
		$stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' ORDER BY id ' . 'LIMIT '. $limit . ',' . $recordsOnPage);
		$stmt->execute();

		for($page = 1; $page<= $numberOfPage; $page++) {  
			echo '<a href = "index2.php?page=' . $page . '">' . $page . ' </a>';  
		}
	}

	//used to retrieve images

	public function lastInsertId() {
        return $this->pdo->lastInsertId();

    }
}

