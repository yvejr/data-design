/**
* list of topics by name and id
* includes mutator and accessor for topic name and id
**/
class Topic {
    //this is the name assigned to the topic
    private $topicName;
    //mutator method for topic name
    public function setTopicName($newTopicName) : void {
        // verify the topic name is secure, if not then display an error message
        $newTopicName = trim($newTopicName);
        $newTopicName = filter_var($newTopicName FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        if(empty($newTopicName) === true) {
                throw(new \InvalidArgumentException("topic name is either empty or insecure"));
}
        // verify the topic name length will fit in the database
        if(strlen($newTweetContent) > 16) {
                throw(new \RangeException("title length too large; max of 16 characters"));
}
//accessor for topic name
    public function getTopicName() : string {
        return($this->topicName);
    }
}
