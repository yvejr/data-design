<?php
namespace Edu\Cnm\DataDesign;

require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 * Small Cross Section of a journal reference from Science Daily
 *
 *
 * @author Yvette Johnson-Rodgers <itsyvejr@gmail.com>
 * @version 1.0
 **/
class Topic implements \JsonSerializable {
    use ValidateUuid;
    /**
     * id for this Topic; this is the primary key
     * @var Uuid $topicId
     **/
    private $topicId;
    /**
     * actual textual name of this Topic
     * @var string $topicName
     **/
    private $topicName;
    /**
     * constructor for this Topic
     *
     * @param string|Uuid $newTopicId id of this Topic or null if a new Topic
     * @param string $newTopicName string containing actual topic data
     * @throws \InvalidArgumentException if data types are not valid
     * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
     * @throws \TypeError if data types violate type hints
     * @throws \Exception if some other exception occurs
     * @Documentation https://php.net/manual/en/language.oop5.decon.php
     **/
    public function __construct($newTopicId, string $newTopicName) {
        try {
            $this->setTopicId($newTopicId);
            $this->setTopicName($newTopicName);
        }
            //determine what exception type was thrown
        catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
            $exceptionType = get_class($exception);
            throw(new $exceptionType($exception->getMessage(), 0, $exception));
        }
    }

    /**
     * accessor method for topic id
     *
     * @return Uuid value of topic id
     **/
    public function getTopicId() : Uuid {
        return($this->topicId);
    }

    /**
     * mutator method for topic id
     *
     * @param Uuid|string $newTopicId new value of topic id
     * @throws \RangeException if $newTopicId is not positive
     * @throws \TypeError if $newtTopicId is not a uuid or string
     **/
    public function setTopicId( $newTopicId) : void {
        try {
            $uuid = self::validateUuid($newTopicId);
        } catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
            $exceptionType = get_class($exception);
            throw(new $exceptionType($exception->getMessage(), 0, $exception));
        }

        // convert and store the topic id
        $this->topicId = $uuid;
    }
    /**
     * accessor method for topic name
     *
     * @return string value of topic name
     **/
    public function getTopicName() : string {
        return($this->topicName);
    }

    /**
     * mutator method for topic name
     *
     * @param string $newTopicName new value of topic name
     * @throws \InvalidArgumentException if $newTopicName is not a string or insecure
     * @throws \RangeException if $newTopicName is > 140 characters
     * @throws \TypeError if $newTopicName is not a string
     **/
    public function setTopicName(string $newTopicName) : void {
        // verify the topic name is secure
        $newTopicName = trim($newTopicName);
        $newTopicName = filter_var($newTopicName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        if(empty($newTopicName) === true) {
            throw(new \InvalidArgumentException("topic name is empty or insecure"));
        }

        // verify the topic name will fit in the database
        if(strlen($newTopicName) > 140) {
            throw(new \RangeException("name too large"));
        }

        // store the topic name
        $this->topicName = $newTopicName;
    }

    /**
     * inserts this topic into mySQL
     *
     * @param \PDO $pdo PDO connection object
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError if $pdo is not a PDO connection object
     **/
    public function insert(\PDO $pdo) : void {

        // create query template
        $query = "INSERT INTO topic(topicId,topicName) VALUES(:topicId, :topicName)";
        $statement = $pdo->prepare($query);

        // bind the member variables to the place holders in the template
        $parameters = ["topicId" => $this->topicId->getBytes(),"topicName" => $this->topicName];
        $statement->execute($parameters);
    }


    /**
     * deletes this topic from mySQL
     *
     * @param \PDO $pdo PDO connection object
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError if $pdo is not a PDO connection object
     **/
    public function delete(\PDO $pdo) : void {

        // create query template
        $query = "DELETE FROM topic WHERE topicId = :topicId";
        $statement = $pdo->prepare($query);

        // bind the member variables to the place holder in the template
        $parameters = ["topicId" => $this->topicId->getBytes()];
        $statement->execute($parameters);
    }

    /**
     * updates this topic in mySQL
     *
     * @param \PDO $pdo PDO connection object
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError if $pdo is not a PDO connection object
     **/
    public function update(\PDO $pdo) : void {

        // create query template
        $query = "UPDATE topic SET topicName = :topicName WHERE topicId = :topicId";
        $statement = $pdo->prepare($query);

        $parameters = ["topicId" => $this->topicId->getBytes(),"topicName" => $this->topicName,];
        $statement->execute($parameters);
    }

    /**
     * gets the topic by topicId
     *
     * @param \PDO $pdo PDO connection object
     * @param Uuid|string $topicId topic id to search for
     * @return topic|null topic found or null if not found
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError when a variable are not the correct data type
     **/
       public static function getTopicByTopicId(\PDO $pdo, $topicId) : ?topic {
        // sanitize the topicId before searching
        try {
            $topicId = self::validateUuid($topicId);
        } catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
            throw(new \PDOException($exception->getMessage(), 0, $exception));
        }

        // create query template
        $query = "SELECT topicId, topicName FROM topic WHERE topicId = :topicId";
        $statement = $pdo->prepare($query);

        // bind the topic id to the place holder in the template
        $parameters = ["topicId" => $topicId->getBytes()];
        $statement->execute($parameters);

        // grab the topic from mySQL
        try {
            $topic = null;
            $statement->setFetchMode(\PDO::FETCH_ASSOC);
            $row = $statement->fetch();
            if($row !== false) {
                $topic = new Topic($row["topicId"], $row["topicName"]);
            }
        } catch(\Exception $exception) {
            // if the row couldn't be converted, rethrow it
            throw(new \PDOException($exception->getMessage(), 0, $exception));
        }
        return($topic);
    }
    /**
     * gets the topic by name
     *
     * @param \PDO $pdo PDO connection object
     * @param string $topicName topic name to search for
     * @return \SplFixedArray SplFixedArray of topics found
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError when variables are not the correct data type
     **/
    public static function getTopicByTopicName(\PDO $pdo, string $topicName) : \SplFixedArray {
        // sanitize the description before searching
        $topicName = trim($topicName);
        $topicName = filter_var($topicName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        if(empty($topicName) === true) {
            throw(new \PDOException("topic content is invalid"));
        }

        // escape any mySQL wild cards
        $topicName = str_replace("_", "\\_", str_replace("%", "\\%", $topicName));

        // create query template
        $query = "SELECT topicId, topicName FROM topic WHERE topicName";
        $statement = $pdo->prepare($query);

        // bind the topic content to the place holder in the template
        $topicName = "%$topicName%";
        $parameters = ["topicName" => $topicName];
        $statement->execute($parameters);

        // build an array of topics
        $topics = new \SplFixedArray($statement->rowCount());
        $statement->setFetchMode(\PDO::FETCH_ASSOC);
        while(($row = $statement->fetch()) !== false) {
            try {
                $topic = new Topic($row["topicId"], $row["topicName"]);
                $topics[$topics->key()] = $topic;
                $topics->next();
            } catch(\Exception $exception) {
                // if the row couldn't be converted, rethrow it
                throw(new \PDOException($exception->getMessage(), 0, $exception));
            }
        }
        return($topics);
    }

    /**
     * gets all topics
     *
     * @param \PDO $pdo PDO connection object
     * @return \SplFixedArray SplFixedArray of topics found or null if not found
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError when variables are not the correct data type
     **/
    public static function getAllTopics(\PDO $pdo) : \SPLFixedArray {
        // create query template
        $query = "SELECT topicId FROM topic";
        $statement = $pdo->prepare($query);
        $statement->execute();

        // build an array of topics
        $topics = new \SplFixedArray($statement->rowCount());
        $statement->setFetchMode(\PDO::FETCH_ASSOC);
        while(($row = $statement->fetch()) !== false) {
            try {
                $topic = new topic($row["topicId"], $row["topicName"]);
                $topics[$topics->key()] = $topic;
                $topics->next();
            } catch(\Exception $exception) {
                // if the row couldn't be converted, rethrow it
                throw(new \PDOException($exception->getMessage(), 0, $exception));
            }
        }
        return ($topics);
    }

    /**
     * formats the state variables for JSON serialization
     *
     * @return array resulting state variables to serialize
     **/
    public function jsonSerialize() : array {
        $fields = get_object_vars($this);

        $fields["topicId"] = $this->topicId->toString();
    }
}
