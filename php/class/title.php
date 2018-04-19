<?php
/**
 * list of topics by name and id
 *
 * includes mutator and accessor for topic name and id
 **/

class Topic
{
    //this is the name assigned to the topic
    private $topicName;

    //this is the id assigned to the topic
    private $topicId;

    /**
     * mutator method for topic name
     **/
    public function setTopicName($newTopicName): void
    {
        $newTopicName = trim($newTopicName);

        //verify the topic name is secure, if not then display error message
        $newTopicName = filter_var($newTopicName FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    if (empty($newTopicName) === true) {
        throw(new \InvalidArgumentException("topic name is either empty or insecure"));
    }
    //verify the topic name length will fit in the database
    if (strlen($newTitleContent) > 16) {
        throw(new \RangeException("title length too large; max of 16 characters"));
    }
    }

    /**
     *accessor for topic name
     **/
    public function getTopicName(): string
    {
        return ($this->topicName);
    }

    /**
     * mutator method for topic id
     **/
    public function setTopicId($newTopicId): void
    {
        {
            $newTopicId = trim($newTopicName);
            try {
                $uuid = self::validateUuid($newtitleId);
            } catch (\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
                newTopicName = filter_var($newTopicName FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    if (empty($newTopicName) === true) {
        throw(new \InvalidArgumentException("topic name is either empty or insecure"));
    }
    }

            //verify the topic name length will fit in the database
            if (strlen($newtitleContent) > 16) {
                throw(new \RangeException("title length too large; max of 16 characters"));
            }
            /**
             * accessor for topic name
             **/
            $exceptionType = get_class($exception);
            throw(new $exceptionType($exception->getMessage(), 0, $exception));
        }

        // convert and store the title id
        $this->titleId = $uuid;
    }
/**
 *accessor method for topic id
 **/
    public function getTopicId() : Uuid{
            return($this->topicProfileId);
    }
}
