<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stranke.css">
    <title>Document</title>
</head>
<body>
    <?php require 'header.php';
    
    $conn = OpenCon();
    $sql = "SELECT * FROM `stranke`";
    

    ?> 

    
    <div class="container">
    <div class="container-fluid p-0">
 
		<div class="row">
			<div class="col-xl-8">
				<div class="card">
					<div class="card-header pb-0">
                    <input id="searchbar" onkeyup="isci()" type="text" name="search" placeholder="Poišči stranko">
					</div>
					<div class="card-body">
						<table id="izpis" class="table table-striped" style="width:100%">
							<thead>
								<tr>
									<th>Ime</th>
									<th>Email</th>
									<th>Telefon</th>
                                    <th>Ogled</th>
								</tr>
							</thead>
							<tbody>
                                <?php
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc())
                                {
                                echo "<tr>";
                                echo "<td>".$row['ime']." ".$row['priimek']."</td>";
                                echo "<td>".$row['email']."</td>";
                                echo "<td>".$row['telefon']."</td>";
                                echo "<td>".$row['stranka_id']."</td>";
                                echo "</tr>";
                                }
                                ?>
								
							
							</tbody>
						</table>
					</div>
				</div>
			</div>

	</div>
</div>

<script src="iskanje.js"></script>
</body>
</html>