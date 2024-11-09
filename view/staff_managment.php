<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Require CSS -->
    <link rel="stylesheet" href="src/css/index.css">
    <link rel="stylesheet" href="src/css/nav_block.css">
    <link rel="stylesheet" href="src/css/staff_managment.css">

    <!-- СhartJS library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>Staff managment - CMS</title>
</head>
<body>
    <?php
        // Start session
        session_start();

        // Require users model
        require("/Users/danielmihai/Documents/code/cms_php/model/usersModel.php");
    ?>

    <!-- Wrapper -->
    <div class="wrapper">
        <!-- Navigation block -->
        <div class="nav">
            <div class="user-info">
                <h2>Admin Panel (CMS)</h2>
                <img src="src/images/anton.png" alt="<?= $_SESSION["user"][0]["login"] ?? '' ?>">
                <p><?= $_SESSION["user"][0]["login"] ?? '' ?></p>
            </div>

            <nav>
                <a href="/view/dashboard.php">Dashboard</a>
                <a href="/view/orders_managment.php">Orders managment</a>
                <a href="/view/staff_managment.php">Staff managment</a>
                <a href="">Products managment</a>
            </nav>
        </div>

        <!-- Right container -->
        <div class="container-right">
            <h1>Staff Managment</h1>

            <table>
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Access</td>
                        <td>Details</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usersInfo as $el) { ?>
                   <tr>
                        <td><?= $el["login"] ?></td>
                        <td><?= $el["email"] ?></td>
                        <td><?= $el["access"] ?></td>
                        <td><a href="">More info</a></td>
                   </tr>
                   <?php } ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++) {
                    if ($i == $page) {
                        echo '<strong>' . $i . '</strong> ';
                    } else {
                        echo '<a href="/view/staff_managment.php?page=' . $i . '">' . $i . '</a> ';
                    }
                } ?>
            </div>

            <!-- Chart -->
            <canvas id="myChart" class="canvas"></canvas>

            <script>
                // Data from PHP to JS
                const labels1 = <?php echo json_encode($label); ?>;
                const data = <?php echo json_encode($data); ?>;

                // Chart elements
                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                    labels: labels1,
                    datasets: [{
                        label: 'Number of Users',
                        data: data,
                        backgroundColor: [
                            'rgba(220, 53, 69, 0.5)', // Admin
                            'rgba(40, 167, 69, 0.5)', // Manager
                            'rgba(23, 162, 184, 0.5)' // Staff
                        ],
                        borderColor: [
                            '#DC3545',
                            '#28A745',
                            '#17A2B8'
                        ],
                        borderWidth: 1
                        }
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
                });
            </script>
        </div>
    </div>
</body>
</html>