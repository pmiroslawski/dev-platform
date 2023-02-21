<?php error_reporting(E_ALL); ?>
<html>
    <head>
        <title>Platform DEV connection check</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <h2>Platform DEV connection check</h2>
    <hr/>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Service</th>
                    <th scope="col">Status</th>
                    <th scope="col">Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>MariaDB</td>
                    <td>
                        <?php
                            $result = $error = null;
                            try {
                                $pdo = new PDO(
                                    'mysql:host=10.56.1.10;dbname=demo_app', 'demo_app_user', 'demo_app_pass',
                                );
                                $result = true;
                            } catch (Exception $e) {
                                $result = false;
                                $error = print_r($e->getMessage(), true);
                            }
                        ?>
                        <?php if ($result): ?>
                            <div class="text-success">OK</div>
                        <?php else: ?>
                            <div class="text-danger">FAILED</div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="text-secondary"><pre><?= $error ?: $data ?? '' ?></pre></div>
                    </td>
                </tr>

                <tr>
                    <td>Redis</td>
                    <td>
                        <?php
                            $result = $error = null;
                            try {
                                $redis = new Redis();
                                $redis->connect('10.56.1.20');
                                $result = true;
                            } catch (Exception $e) {
                                $result = false;
                                $error = print_r($e->getMessage(), true);
                            }
                        ?>
                        <?php if ($result): ?>
                            <div class="text-success">OK</div>
                        <?php else: ?>
                            <div class="text-danger">FAILED</div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="text-secondary"><pre><?= $error ?: $data ?? '' ?></pre></div>
                    </td>
                </tr>


                <tr>
                    <td>RabbitMQ</td>
                    <td>
                        <?php
                            $result = $error = null;
                            try {
                                $connection = new AMQPConnection();
                                $connection->setHost('10.56.1.30');
                                $connection->setLogin('admin');
                                $connection->setPassword('pass');
                                $connection->setVhost('/');
                                if ($connection->connect()) {
                                    $result = true;
                                }
                            } catch (Exception $e) {
                                $result = false;
                                $error = print_r($e->getMessage(), true);
                            }
                        ?>
                        <?php if ($result): ?>
                            <div class="text-success">OK</div>
                        <?php else: ?>
                            <div class="text-danger">FAILED</div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="text-secondary"><pre><?= $error ?: $data ?? '' ?></pre></div>
                    </td>
                </tr>

                <tr>
                    <td>Elasticsearch</td>
                    <td>
                        <?php
                            $result = $error = null;
                            try {
                                $data = print_r(file_get_contents('http://10.56.1.40:9200/_cluster/health?pretty'), true);
                                $result = true;
                            } catch (Exception $e) {
                                $result = false;
                                var_dump($e->getMessage());
                            }
                        ?>
                        <?php if ($result): ?>
                            <div class="text-success">OK</div>
                        <?php else: ?>
                            <div class="text-danger">FAILED</div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="text-secondary"><pre><?= $error ?: $data ?? '' ?></pre></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
