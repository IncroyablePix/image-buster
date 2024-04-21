<?php

$pdo = new PDO("sqlite:database.db");
$stmt = $pdo->prepare("SELECT * FROM user_data");
$stmt->execute();
$rows = $stmt->fetchAll();

?>
<!DOCTYPE html>
<head>
    <title>Data</title>
    <style>
        table {
            border-collapse: collapse;
            border: 2px solid rgb(140 140 140);
            font-family: sans-serif;
            font-size: 0.8rem;
            letter-spacing: 1px;
        }

        caption {
            caption-side: bottom;
            padding: 10px;
            font-weight: bold;
        }

        thead, tfoot {
            background-color: rgb(228 240 245);
        }

        th, td {
            border: 1px solid rgb(160 160 160);
            padding: 8px 10px;
        }

        td:last-of-type {
            text-align: center;
        }

        tbody > tr:nth-of-type(even) {
            background-color: rgb(237 238 242);
        }

        tfoot th {
            text-align: right;
        }

        tfoot td {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>User agent</th>
                <th>IP Address</th>
                <th>Forwarded</th>
                <th>Date</th>
                <th>Referrer</th>
                <th>Language</th>
                <th>Device Type</th>
                <th>Browser version</th>
                <th>Operating System</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row) {
                echo "<tr>";
                echo "<td>" . $row["user_agent"] . "</td>";
                echo "<td>" . $row["ip_address"] . "</td>";
                echo "<td>" . $row["forwarded"] . "</td>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td>" . $row["referrer"] . "</td>";
                echo "<td>" . $row["language"] . "</td>";
                echo "<td>" . $row["device_type"] . "</td>";
                echo "<td>" . $row["browser_version"] . "</td>";
                echo "<td>" . $row["operating_system"] . "</td>";
                echo "</tr>";
            } ?>
        </tbody>
    </table>
</body>