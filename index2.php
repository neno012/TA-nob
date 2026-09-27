<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <title>Sistem Monitoring 3 Phase</title>
    <style>
        /* Styling opsional untuk tinggi konten agar footer terlihat di bagian bawah */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        .chart-container {
            width: 90%;
            /* Sesuaikan lebar grafik */
            margin: 20px auto;
            /* Pusatkan grafik */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">TRIPHASE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="bg-light py-5 text-center">
        <div class="container">
            <h1 class="display-4">Selamat Datang di Situs Kami!</h1>
            <p class="lead">Temukan berbagai informasi Triphase terbaik di sini.</p>
        </div>
    </header>
    <?php 
    $json = file_get_contents('data.json');
    $data = json_decode($json, true);
    var_dump($data['fuzzy']);
    ?>

    <main class="container my-5">
        <div class="row">
            <div class="col-md-6 mx-auto text-center">
                <div class="chart-container">
                    <canvas id="myMultiParamChart"></canvas>
                </div>
            </div>
            <div class="col-md-6 mx-auto text-center">
                <div class="chart-container">
                    <canvas id="arusChart"></canvas>
                </div>
            </div>
            <div class="col-md-6 mx-auto text-center">
                <div class="chart-container">
                    <canvas id="powerChart"></canvas>
                </div>
            </div>
            <div class="col-md-6 mx-auto text-center">
                <div class="chart-container">
                    <canvas id="dayaChart"></canvas>
                </div>
            </div>
            <div class="col-md-6 mx-auto text-center">
                <div class="chart-container">
                    <canvas id="frekuensiChart"></canvas>
                </div>
            </div>
            <div class="col-md-6 mx-auto text-center">
                <div class="chart-container">
                    <canvas id="energiChart"></canvas>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container text-center">
            <p>&copy; Triphase 2025. Hak Cipta Dilindungi.</p>
            <p>
                <a href="#" class="text-white me-2">Privasi</a>
                <a href="#" class="text-white ms-2">Ketentuan</a>
            </p>
        </div>
    </footer>
    <script>
        // Dapatkan konteks elemen canvas
        const ctx = document.getElementById('myMultiParamChart').getContext('2d');
        const ctx_arus = document.getElementById('arusChart').getContext('2d');

        const ctx_power = document.getElementById('powerChart').getContext('2d');
        const ctx_daya = document.getElementById('dayaChart').getContext('2d');
        const ctx_frekuensi = document.getElementById('frekuensiChart').getContext('2d');
        const ctx_energi = document.getElementById('energiChart').getContext('2d');

        // Data untuk grafik
        const data = {
            labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9'], // Label untuk sumbu X
            datasets: [{
                    label: 'R', // Label untuk dataset pertama
                    data: [20, 22, 21, 23, 25, 24, 26], // Data aktual untuk parameter A
                    borderColor: 'rgba(255, 99, 132, 1)', // Warna garis
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Warna area di bawah garis (opsional)
                    borderWidth: 2,
                    fill: false, // Jangan mengisi area di bawah garis
                    tension: 0.3 // Kehalusan garis
                },
                {
                    label: 'S', // Label untuk dataset kedua
                    data: [70, 68, 72, 75, 70, 73, 71], // Data aktual untuk parameter B
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.3
                },
                {
                    label: 'T', // Label untuk dataset ketiga
                    data: [30, 35, 20, 15, 50, 45, 65], // Data aktual untuk parameter C
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.3
                }
            ]
        };

        // Konfigurasi opsi grafik
        const config = {
            type: 'line', // Tipe grafik adalah 'line'
            data: data,
            options: {
                responsive: true, // Membuat grafik responsif
                plugins: {
                    title: {
                        display: true,
                        text: 'Grafik Tegangan PZEM (V)' // Judul grafik
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Waktu (min)' // Label untuk sumbu X
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Nilai' // Label untuk sumbu Y
                        }
                    }
                }
            }
        };
        const config2 = {
            type: 'line', // Tipe grafik adalah 'line'
            data: data,
            options: {
                responsive: true, // Membuat grafik responsif
                plugins: {
                    title: {
                        display: true,
                        text: 'Grafik Arus PZEM (V)' // Judul grafik
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Waktu (min)' // Label untuk sumbu X
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Nilai' // Label untuk sumbu Y
                        }
                    }
                }
            }
        };
        const config_power = {
            type: 'line', // Tipe grafik adalah 'line'
            data: data,
            options: {
                responsive: true, // Membuat grafik responsif
                plugins: {
                    title: {
                        display: true,
                        text: 'Power Faktor PZEM (V)' // Judul grafik
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Waktu (min)' // Label untuk sumbu X
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Nilai' // Label untuk sumbu Y
                        }
                    }
                }
            }
        };
        const config_daya = {
            type: 'line', // Tipe grafik adalah 'line'
            data: data,
            options: {
                responsive: true, // Membuat grafik responsif
                plugins: {
                    title: {
                        display: true,
                        text: 'Daya Aktif PZEM (V)' // Judul grafik
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Waktu (min)' // Label untuk sumbu X
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Nilai' // Label untuk sumbu Y
                        }
                    }
                }
            }
        };
        const config_frekuensi = {
            type: 'line', // Tipe grafik adalah 'line'
            data: data,
            options: {
                responsive: true, // Membuat grafik responsif
                plugins: {
                    title: {
                        display: true,
                        text: 'Frekuensi PZEM (V)' // Judul grafik
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Waktu (min)' // Label untuk sumbu X
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Nilai' // Label untuk sumbu Y
                        }
                    }
                }
            }
        };
        const config_energi = {
            type: 'line', // Tipe grafik adalah 'line'
            data: data,
            options: {
                responsive: true, // Membuat grafik responsif
                plugins: {
                    title: {
                        display: true,
                        text: 'Energy PZEM (V)' // Judul grafik
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Waktu (min)' // Label untuk sumbu X
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Nilai' // Label untuk sumbu Y
                        }
                    }
                }
            }
        };

        // Buat grafik baru
        const myChart = new Chart(ctx, config);
        const myChart2 = new Chart(ctx_arus, config2);
        const powerChart = new Chart(ctx_power, config_power);
        const dayaChart = new Chart(ctx_daya, config_daya);
        const frekuensiChart = new Chart(ctx_frekuensi, config_frekuensi);
        const energiChart = new Chart(ctx_energi, config_energi);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>