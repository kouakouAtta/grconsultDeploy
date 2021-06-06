<?php
namespace Application\Model;

use Zend\Db\TableGateway\AbstractTableGateway,
    Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\Sql\Select;

class ContactTable extends AbstractTableGateway
{
    protected $table ='contact';
    protected $tableName ='contact';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet(new Contact);

        $this->initialize();
    }

    public function fetchAll($where=null)
    {
        $resultSet = $this->select($where);
        return $resultSet;
    }
    
    public function newSelect() {
    	return new Select;
    }
    
    public function getSelect(&$select,$columnsArray=[]) 
    {
    	$select = new Select;
    	return $select->from('contact')->columns($columnsArray);    	
    }
    
    public function createIfNotExist($checkColumnsArray,$optionalColumns=[],&$isRowCreated=null) {
			$rowset=$this->select($checkColumnsArray);
    		$row = $rowset->current();
    		$id=null;
    		if ($row == null) {
    			$allColumns=array_merge($checkColumnsArray,$optionalColumns);
    			$affectedRows = $this->insert($allColumns);
    			if ($affectedRows != 1) {
    				throw new \Exception("error: could not add line to db");
    			}
    			$id=$this->lastInsertValue;
    			$isRowCreated=true;
    		} else {
    			$id=$row->id;
    			$isRowCreated=false;
    		}
    		return $id;
    }
    
    //http://stackoverflow.com/questions/6156942/how-do-i-insert-an-empty-row-but-have-the-autonumber-update-correctly
    
    public function createEmptyRow() {
    	$row=[
    	'id' => null
    	];
    	$affectedRows=$this->insert($row);
 		if ($affectedRows != 1) {
    		throw new \Exception("error: could not add empty row to db");
    	}
    	$id=$this->lastInsertValue;
    	return $id;
	}
    
    public function getContact($id)
    {
        $id  = (int) $id;
        $rowset = $this->select(['id' => $id]);
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveContact(Contact $contact)
    {
        $data = [];
        foreach ($contact as $key => $value) {
            if(!is_null($value)){
                $data[$key] = $value;
            }
        }

        $id = (int)$contact->id;
        if ($id == 0) {
            $this->insert($data);
        } else {
            if ($this->getContact($id)) {
                $this->update($data, ['id' => $id]);
            } else {
                throw new \Exception('Form id does not exit');
            }
        }
    }

    public function addContact($contactLocalisatonAdresse, $telephone, $horaire, $email, $dateCreation, $dateModification = null)
    {
        $data = [       
                        'contactLocalisatonAdresse'=>$contactLocalisatonAdresse,
                        'telephone' => $telephone,
                        'horaire' => $horaire,
                        'email' => $email,
                        'dateCreation' => $dateCreation,
                        'dateModification' => $dateModification,
                    ];
        $affectedRows=$this->insert($data);
                if ($affectedRows != 1) {
        	return null;
        }
        return $this->lastInsertValue;
            }

    public function updateContact($id, $contactLocalisatonAdresse, $telephone, $horaire, $email, $dateCreation, $dateModification)
    {
        $data = [
        	        'contactLocalisatonAdresse' => $contact->contactLocalisatonAdresse,
                        'telephone' => $contact->telephone,
                        'email' => $contact->email,
                        'horaire' => $contact->horaire,
                        'dateCreation' => $contact->dateCreation,
                        'dateModification' => $contact->dateModification,
                            ];
        $this->update($data, [id => $id]);
    }

    public function deleteContact($id)
    {
        $this->delete(['id' => $id]);
    }
    
    public function getInfos(){
        $result = $this->fetchAll('id=1');
        return $result->count() > 0 ? $result->current() : null;
    }
}
