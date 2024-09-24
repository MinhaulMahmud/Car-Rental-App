<!DOCTYPE html>
<html>
<head>
	<title>Dashboard Overview</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="dashboard-container">
		<div class="header">
			<h1>Dashboard Overview</h1>
		</div>
		<div class="key-statistics">
			<h2>Key Statistics</h2>
			<ul>
				<li>
					<span>Total Number of Cars:</span>
					<span class="stat-value">500</span>
					<div class="stat-icon">
						<i class="fas fa-car"></i>
					</div>
				</li>
				<li>
					<span>Number of Available Cars:</span>
					<span class="stat-value">200</span>
					<div class="stat-icon">
						<i class="fas fa-car"></i>
					</div>
				</li>
				<li>
					<span>Total Number of Rentals:</span>
					<span class="stat-value">1000</span>
					<div class="stat-icon">
						<i class="fas fa-chart-line"></i>
					</div>
				</li>
				<li>
					<span>Total Earnings from Rentals:</span>
					<span class="stat-value">$50,000</span>
					<div class="stat-icon">
						<i class="fas fa-dollar-sign"></i>
					</div>
				</li>
			</ul>
		</div>
	</div>

	<script src="https://kit.fontawesome.com/your-font-awesome-kit-id.js"></script>
</body>
<style>
    body {
  background-color: #f7f7f7; /* light grey background */
}

.dashboard-container {
  max-width: 800px;
  margin: 40px auto;
  padding: 20px;
  background-color: #fff;
  border: 1px solid #ddd;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
}

.header {
  background-color: #337ab7; /* dark blue background */
  color: #fff;
  padding: 10px;
  border-radius: 10px 10px 0 0;
}

h1, h2 {
  color: #333;
  margin-bottom: 10px;
}

.key-statistics {
  margin-top: 20px;
}

.key-statistics ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.key-statistics li {
  margin-bottom: 20px;
  padding: 10px;
  border-bottom: 1px solid #ddd;
}

.key-statistics li:last-child {
  border-bottom: none;
}

.key-statistics li span {
  display: inline-block;
  width: 200px;
  font-weight: bold;
  color: #666;
}

.stat-value {
  font-size: 18px;
  font-weight: bold;
  color: #337ab7;
}

.stat-icon {
  float: right;
  font-size: 24px;
  color: #337ab7;
}

.stat-icon i {
  margin-right: 10px;
}
</style>
</html>