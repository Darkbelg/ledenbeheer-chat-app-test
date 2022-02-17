<?php
namespace Database;

class ChatSessionsDOA
{
    private $databaseConnection;
    public function __construct($databaseConnection)
    {
        $this->databaseConnection = $databaseConnection;
    }

    public function get($firstname, $lastname, $email)
    {
        $stmt = $this->databaseConnection->prepare( "SELECT id,firstname from chat_sessions where firstname like ? AND lastname like ? AND email like ?");
        $stmt->bind_param("sss",$firstname,$lastname,$email);
        $stmt->execute();
        $results = $stmt->get_result();
        return $results->fetch_assoc();
    }

    public function create($firstname, $lastname, $email)
    {
        try {
            $created_at = (new \DateTime("now"))->format("Y-m-d H:i:s");
            $stmt = $this->databaseConnection->prepare( "INSERT INTO chat_sessions (created_at,firstname,lastname,email) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss",$created_at,$firstname,$lastname,$email);
            $stmt->execute();
        } catch (\Exception $e){
            throw new \Exception("Failed to create session");
        }
    }
}