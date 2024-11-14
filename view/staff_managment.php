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
        // Require access model
        require("/Users/danielmihai/Documents/code/cms_php/model/accessModel.php");
    ?>

    <!-- Overlay -->
    <div class="overlay"></div>
    <!-- Wrapper -->
    <div class="wrapper">
        <!-- Navigation block -->
        <div class="nav">
            <div class="user-info">
                <h2>Admin Panel (CMS)</h2>
                <img src="src/avatars/<?= $_SESSION["user"][0]["photo"] ?>" alt="<?= $_SESSION["user"][0]["login"] ?? '' ?>">
                <p><?= $_SESSION["user"][0]["login"] ?? '' ?></p>
            </div>

            <nav>
                <a href="/view/dashboard.php">Dashboard</a>
                <a href="/view/orders_managment.php">Orders managment</a>
                <a href="/view/staff_managment.php">Staff managment</a>
                <a href="/view/products_managment.php">Products managment</a>
            </nav>
        </div>

        <!-- Right container -->
        <div class="container-right">
            <h1>Staff Managment</h1>

            <?php if ($_SESSION["user"][0]["access"] == "Admin" || $_SESSION["user"][0]["access"] == "Manager") { ?>
            <div class="create-user">
                <button id="openForm-btn">Create new user</button>

                <div class="create-user--form">
                    <form action="/controller/addUserController.php" method="POST" enctype="multipart/form-data">
                        <div class="svg">
                            <svg id="closeForm-btn" version="1.0" xmlns="http://www.w3.org/2000/svg" width="8.000000pt" height="8.000000pt" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet"><g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none"><path d="M245 5111 c-92 -24 -173 -90 -215 -176 -35 -71 -35 -198 -1 -270 19 -40 223 -249 1050 -1078 l1026 -1027 -1026 -1028 c-1115 -1116 -1066 -1062 -1077 -1188 -10 -126 53 -240 168 -303 61 -33 71 -36 150 -35 68 0 95 5 135 24 41 19 244 217 1078 1049 l1027 1026 1028 -1026 c833 -832 1036 -1030 1077 -1049 40 -19 67 -24 135 -24 78 -1 90 2 148 33 70 38 100 70 140 145 36 71 38 196 2 271 -19 41 -217 244 -1049 1077 l-1026 1028 1026 1028 c832 833 1030 1036 1049 1077 19 40 24 67 24 135 1 78 -2 90 -33 148 -38 70 -70 100 -145 140 -71 36 -196 38 -271 2 -41 -19 -244 -217 -1077 -1049 l-1028 -1026 -1027 1026 c-838 837 -1037 1030 -1077 1048 -53 24 -161 36 -211 22z"/></g></svg>
                        </div>
                        <h3>Create new user</h3>
                        <label for="login">Login</label>
                        <input type="text" name="login" placeholder="Stipe Miocic">
                        <label for="email">Email</label>
                        <input type="email" name="email" placeholder="miocic@mail.ru">
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="********">
                        <label for="rePassoword">Confirm password</label>
                        <input type="password" name="rePassword" placeholder="********">
                        <label for="access">Access</label>
                        <select name="access" id="access">
                            <?php foreach ($access_info as $el) { ?>
                                <option value="<?= $el['access'] ?>"><?= $el["access"] ?></option>
                            <?php } ?>
                        </select>
                        <label for="photo">Upload image</label>
                        <input type="file" name="photo">

                        <button type="submit">Create</button>
                    </form>
                </div>
            </div>
            <?php } ?>

            <!-- Errors alert -->
            <?php if (isset($_SESSION["error_addUser"])) { ?>
                <div class="alert">
                    <span><?= $_SESSION["error_addUser"] ?></span>
                </div>
                <?php unset($_SESSION["error_addUser"]); ?>
            <?php } ?>

            <!-- Success alert -->
            <?php if (isset($_SESSION["success_addUser"])) { ?>
                <div class="alert success">
                    <span><?= $_SESSION["success_addUser"] ?></span>
                </div>
                <?php unset($_SESSION["success_addUser"]); ?>
            <?php } ?>

            <table>
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Access</td>
                        <td>Details</td>
                        <td>Remove</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usersInfo as $el) { ?>
                   <tr>
                        <td><?= $el["login"] ?></td>
                        <td><?= $el["email"] ?></td>
                        <td><?= $el["access"] ?></td>
                        <td><a href="/view/staff_info.php?id=<?= $el["id"] ?>">More info</a></td>
                        <td><a class="remove-btn" href="/view/staff_managment.php?remove=<?= $el["id"] ?>">Remove</a></td>
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
                        label: 'Amount number of users',
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

    <!-- Require JS -->
    <script src="src/js/modelWindow.js"></script>
</body>
</html>