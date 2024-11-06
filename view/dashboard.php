<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include CSS -->
    <link rel="stylesheet" href="src/css/index.css">
    <link rel="stylesheet" href="src/css/dashboard.css">

    <!-- СhartJS library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>CMS</title>
</head>
<body>
    <?php
        // Start session
        session_start();

        // Require Sales model
        require("/Users/danielmihai/Documents/code/cms_php/model/salesModel.php");
        // Require Sales model for chart
        require("/Users/danielmihai/Documents/code/cms_php/model/sales_chartModel.php");
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
                <a href="">Orders managment</a>
                <a href="">Staff managment</a>
                <a href="">Products managment</a>
            </nav>
        </div>

        <!-- Table -->
        <div class="container-right">
            <h1>Dashboard</h1>
            <table>
                <thead>
                    <tr>
                        <td>Date</td>
                        <td>Amout of sales</td>
                        <td>Successful sales</td>
                        <td>Unsuccessful sales</td>
                        <td>Expenses</td>
                        <td>Income</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($salesInfo as $el) { ?>
                    <tr>
                        <td><?= $el["date"] ?></td>
                        <td><?= $el["amount_of_sales"] ?></td>
                        <td class="successful_sales"><?= $el["successful_sales"] ?></td>
                        <td class="unsuccessful_sales"><?= $el["unsuccessful_sales"] ?></td>
                        <td class="expenses">- <?= number_format($el["expenses"]) ?>$</td>
                        <td class="income">+ <?= number_format($el["income"]) ?>$</td>
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
                        echo '<a href="/view/dashboard.php?page=' . $i . '">' . $i . '</a> ';
                    }
                } ?>
            </div>

            <!-- Chart#1 -->
            <div class="charts">
                <canvas id="myChart"></canvas>
                <canvas id="myChart2"></canvas>
            </div>

            <!-- Chart#1 configuration -->
            <script>
                // Data from PHP to JS
                const labels1 = <?php echo json_encode($labels); ?>;
                const unsuccessful_sales = <?php echo json_encode($unsuccessful_sales); ?>;
                const successful_sales = <?php echo json_encode($successful_sales); ?>;

                // Chart elements
                const ctx1 = document.getElementById('myChart').getContext('2d');
                const myChart1 = new Chart(ctx1, {
                    type: 'bar',
                    data: {
                        labels: labels1,
                        datasets: [{
                            label: 'Unsuccessful Sales',
                            data: unsuccessful_sales, 
                            backgroundColor: 'rgba(220, 53, 69, 0.5)',
                            borderColor: '#DC3545',
                            borderWidth: 1
                        },
                        {
                            label: 'Successful Sales',
                            data: successful_sales, 
                            backgroundColor: 'rgba(40, 167, 69, 0.5)',
                            borderColor: '#28A745',
                            borderWidth: 1
                        }],
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

            <!-- Chart#2 configuration (Pie chart) -->
            <script>
                // Data from PHP to JS
                const labels2 = <?php echo json_encode($labels); ?>;
                const income = <?php echo json_encode($income); ?>;
                const expenses = <?php echo json_encode($expenses); ?>;

                // Sum of array values
                const totalIncome = income.reduce((acc, curr) => acc + curr, 0); 
                const totalExpenses = expenses.reduce((acc, curr) => acc + curr, 0);  

                // Chart elements
                const ctx2 = document.getElementById('myChart2').getContext('2d');
                const myChart2 = new Chart(ctx2, {
                    type: 'pie', 
                        data: {
                            labels: ['Income', 'Expenses'],  
                            datasets: [{
                                data: [totalIncome, totalExpenses],  
                                backgroundColor: ['rgba(0, 123, 255, 0.5)', 'rgba(253, 126, 20, 0.5)'],
                                borderColor: ['#007BFF', '#FD7E14'],
                                borderWidth: 1
                            }]
                        },
                    options: {
                        responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    const total = tooltipItem.dataset.data.reduce((a, b) => a + b, 0);
                                    const currentValue = tooltipItem.raw;
                                    const percentage = Math.floor((currentValue / total) * 100);
                                    return tooltipItem.label + ': ' + percentage + '%';
                                }
                            }
                        }
                    }
                }
            });
        </script>
        </div>
    </div>
</body>
</html>