<?php


namespace Felis;


class Cases extends Table
{
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "case");
    }

    /**
     * Get a case by id
     * @param $id The case by ID
     * @return Object that represents the case if successful,
     *  null otherwise.
     */
    public function get($id) {
        $users = new Users($this->site);
        $usersTable = $users->getTableName();

        $sql = <<<SQL
SELECT c.id, c.client, client.name as clientName,
       c.agent, agent.name as agentName,
       number, summary, status
from $this->tableName c,
     $usersTable client,
     $usersTable agent
where c.client = client.id and
      c.agent=agent.id and
      c.id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new ClientCase($statement->fetch(\PDO::FETCH_ASSOC));
    }

    public function insert($client, $agent, $number) {
        $sql = <<<SQL
insert into $this->tableName(client, agent, number, summary, status)
values(?, ?, ?, "", ?)
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try {
            if($statement->execute([$client,
                        $agent,
                        $number,
                        ClientCase::STATUS_OPEN]
                ) === false) {
                return null;
            }
        } catch(\PDOException $e) {
            return null;
        }

        return $pdo->lastInsertId();
    }

    public function getCases(){
        $users = new Users($this->site);
        $usersTable = $users->getTableName();

        $sql = <<<SQL
SELECT c.id, c.client, client.name as clientName,
       c.agent, agent.name as agentName,
       number, summary, status
from $this->tableName c
INNER JOIN $usersTable client 
ON c.client=client.id
INNER JOIN $usersTable agent 
ON c.agent = agent.id 
ORDER BY c.status DESC, c.number
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $cases = array();
        if ($statement->rowCount() === 0) {
            return $cases;
        }

        foreach($statement as $row){
            $cases[] = new ClientCase($row);
        }

        return $cases;
    }

    public function update($id, $number, $summary, $agent, $status){
        $sql =<<<SQL
update $this->tableName
set agent=?, number=?, summary=?, status=?
where id=?
SQL;

        try {
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);

            $ret = $statement->execute(array($agent, $number, $summary, $status, $id));
        } catch(\PDOException $e) {
            return false;
        }

        if($statement->rowCount() == 0){
            return false;
        }

        return true;
    }

    public function delete($id){
        $sql = <<<SQL
DELETE FROM $this->tableName
WHERE id=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        try{
            $statement->execute(array($id));
        }catch(\PDOException $e){
            return false;
        }
    }
}