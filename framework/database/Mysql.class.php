<?php
class Mysql
{
    protected $conn = false;
    protected $sql;

    public function __construct($config = array())
    {
        $host = isset($config['host']) ? $config['host'] : 'localhost';

        $user = isset($config['user']) ? $config['user'] : 'root';

        $password = isset($config['password']) ? $config['password'] : '';

        $dbname = isset($config['dbname']) ? $config['dbname'] : '';

        $port = isset($config['port']) ? $config['port'] : '3306';

        $charset = isset($config['charset']) ? $config['charset'] : '3306';


        $this->conn = mysqli_connect("$host:$port", $user, $password) or die('Database connection error');

        mysqli_select_db($this->conn,$dbname) or die('Database selection error');

        $this->setChar($charset);
    }

    private function setChar($charset)
    {
        $sql = 'set names ' . $charset;

        $this->query($sql);
    }

    /**

     * Thực thi câu lệnh SQL

     * @access public

     * @param $sql string SQL query statement

     * @return $result，if succeed, return resrouces; if fail return error message and exit

     */
    public function query($sql)
    {
        $this->sql = $sql;

        // Write SQL statement into log

        $str = $sql . "  [" . date("Y-m-d H:i:s") . "]" . PHP_EOL;

        file_put_contents("log.txt", $str, FILE_APPEND);

        $result = mysqli_query($this->sql, $this->conn);



        if (!$result) {

            die($this->errno() . ':' . $this->error() . '<br />Error SQL statement is ' . $this->sql . '<br />');
        }

        return $result;
    }


    /**

     * Lấy dòng dữ liệu đầu tiên

     * @access public

     * @param $sql string SQL query statement

     * @return return the value of this column

     */
    public function getOne($sql)
    {
        $result = $this->query($sql);

        $row = mysqli_fetch_row($result);

        if ($row) {

            return $row[0];
        } else {

            return false;
        }
    }

    /**

     * Lấy một hàng

     * @access public

     * @param $sql SQL query statement

     * @return array associative array

     */
    public function getRow($sql)
    {
        if ($result = $this->query($sql)) {

            $row = mysqli_fetch_assoc($result);

            return $row;
        } else {

            return false;
        }
    }


    /**
     * Lấy toàn bộ dữ liệu
     * @access public
     * @param $sql SQL query statement
     * @return $list an 2D array containing all result records
     */
    public function getAll($sql)
    {
        $result = $this->query($sql);

        $list = array();

        while ($row = mysqli_fetch_assoc($result)) {

            $list[] = $row;
        }

        return $list;
    }


    /**

     * Get last insert id

     */

    public function getInsertId(){
        return mysqli_insert_id($this->conn);
    }


    /**
     * Get error number
     * @access private
     * @return error number
     */

    public function errno()
    {
        return mysqli_errno($this->conn);
    }



    /**
     * Lấy nội dung lỗi
     * @access private
     * @return error message
     */
    public function error()
    {
        return mysqli_error($this->conn);
    }
}
