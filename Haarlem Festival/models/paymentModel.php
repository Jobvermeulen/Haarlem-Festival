<?php
//require_once('database.php');
require_once("mysqliPreparer.php");
class PaymentModel
{
    public $connection;

    public function __construct()
    {
        $db = database::getInstance();
        $this->connection = $db->con;
    }

    public function getCustomerId($email, $name)
    {
        $result;
        
        //sql injection secutity
        if ($query = mysqli_multiquery_prepare("select customerID from Customers where email = '" . $email . "'")) {
            $result = $this->connection->query($query);
            
            //if the result has hows get the customerID
            if ($result && $result->num_rows != 0) {
                return $result->fetch_object()->customerID;
            //else insert new customer into Customers and return customerID
            } else {
                if ($query = mysqli_multiquery_prepare("insert into Customers (name, email) values ('{$name}', '{$email}')")) {
                    if ($result = $this->connection->query($query)) {
                        return $this->connection->insert_id;
                    } else {
                        throw new Exception("Insert failed: {$query}");
                    }
                } else {
                    throw new Exception("Multiquery prepare failed: " . $query);
                }
            }
        } else {
            throw new Exception("Prepare failed: " . $query);
        }
    }

    public function confirmPayment($ticket, $customerID, $timestamp, $amount, $totalPrice)
    {
        //get current amount of tickets
        $query = "select quantity from Tickets where ticketID = {$ticket}";
        $result = $this->connection->query($query);

        if ($result) {
            $quantity = $result->fetch_object()->quantity;

            //new amount of tickets
            $quantity -= $amount;

            //if the quantity after mutation > 0
            if ($quantity >= 0) {
                //update tickets and insert new row into sold tickets table
                $query = "update Tickets set quantity = {$quantity} where ticketID = {$ticket}; insert into Sold_Tickets (ticketID, customerID, timestamp, quantity, price) values ({$ticket}, {$customerID}, '{$timestamp}', {$amount}, {$totalPrice})";

                if ($query = mysqli_multiquery_prepare($query)) {
                    $this->connection->multi_query($query);
                } else {
                    throw new Exception("Multiquery prepare failed: {$query}");
                }
            } else {
                throw new Exception("Not enough tickets available for ticketID: " . $ticket);
            }
        } else {
            throw new Exception("No tickets available for ticketID: " . $ticket);
        }
    }
}
?>