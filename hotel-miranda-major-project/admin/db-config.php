<?php
$hname = 'localhost';
$uname = 'root';
$pass = '';
$db = 'min-project-database';

$con = mysqli_connect($hname, $uname, $pass, $db);

if (!$con) {
    die("Cannot connect to database: " . mysqli_connect_error());
}

function filteration($data)
{
    foreach ($data as $key => $value) {
        $data[$key] = trim($value);
        $data[$key] = stripslashes($value);
        $data[$key] = htmlspecialchars($value);
        $data[$key] = strip_tags($value);
    }
    return $data;
}

function select($sql, $values, $datatypes)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);  // Use splat operator to bind values
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_get_result($stmt);  // Fetch the result
            mysqli_stmt_close($stmt);
            return $res;  // Return the result
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - Select: " . mysqli_error($con));
        }
    } else {
        die("Query cannot be prepared - Select: " . mysqli_error($con));
    }
}

function update($sql, $values, $datatypes)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values); // Splat operator to bind multiple values
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt); // Number of affected rows
            mysqli_stmt_close($stmt);
            return $res; // Return affected rows
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - Update: " . mysqli_error($con));
        }
    } else {
        die("Query cannot be prepared - Update: " . mysqli_error($con));
    }
}
?>