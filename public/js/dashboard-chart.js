document.addEventListener('DOMContentLoaded', function() {
    // Grafik Layanan Bulanan
    const ctxLayanan = document.getElementById('layananChart');
    if (ctxLayanan) {
        // Ambil data dari attribute data-*
        const totalLayanan = parseFloat(ctxLayanan.getAttribute('data-total')) || 0;
        
        new Chart(ctxLayanan, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ago', 'Sep', 'Okt'],
                datasets: [{
                    label: 'Layanan',
                    data: [
                        totalLayanan * 0.3,
                        totalLayanan * 0.4,
                        totalLayanan * 0.5,
                        totalLayanan * 0.6,
                        totalLayanan * 0.7,
                        totalLayanan * 0.75,
                        totalLayanan * 0.8,
                        totalLayanan * 0.85,
                        totalLayanan * 0.9,
                        totalLayanan
                    ],
                    borderColor: '#1a4d4d',
                    backgroundColor: 'rgba(26, 77, 77, 0.15)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 3,
                    pointBackgroundColor: '#1a4d4d',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 3,
                    pointRadius: 6,
                    pointHoverRadius: 9,
                    pointHoverBackgroundColor: '#1a4d4d',
                    pointHoverBorderColor: '#fff',
                    pointHoverBorderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: '#1a4d4d',
                            font: {
                                size: 14,
                                weight: 'bold',
                                family: "'Segoe UI', system-ui, sans-serif"
                            },
                            padding: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1a4d4d',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 13,
                            weight: '600'
                        },
                        borderColor: '#7a9b85',
                        borderWidth: 2,
                        padding: 15,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'Total Layanan: ' + Math.round(context.parsed.y);
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(122, 155, 133, 0.1)',
                            lineWidth: 1
                        },
                        ticks: {
                            color: '#1a4d4d',
                            font: {
                                weight: '700',
                                size: 13
                            },
                            padding: 10
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#1a4d4d',
                            font: {
                                weight: '700',
                                size: 13
                            },
                            padding: 10
                        }
                    }
                }
            }
        });
    }

    // Grafik Distribusi (Doughnut)
    const ctxDistribusi = document.getElementById('distribusiChart');
    if (ctxDistribusi) {
        const totalPosyandu = parseInt(ctxDistribusi.getAttribute('data-posyandu')) || 0;
        const totalKader = parseInt(ctxDistribusi.getAttribute('data-kader')) || 0;
        const totalJadwal = parseInt(ctxDistribusi.getAttribute('data-jadwal')) || 0;
        const totalLayanan = parseInt(ctxDistribusi.getAttribute('data-layanan')) || 0;
        
        new Chart(ctxDistribusi, {
            type: 'doughnut',
            data: {
                labels: ['Posyandu', 'Kader', 'Jadwal', 'Layanan'],
                datasets: [{
                    data: [totalPosyandu, totalKader, totalJadwal, totalLayanan],
                    backgroundColor: [
                        '#1a4d4d',
                        '#4a6b5c',
                        '#7a9b85',
                        '#d4b896'
                    ],
                    borderWidth: 4,
                    borderColor: '#fff',
                    hoverOffset: 15,
                    hoverBorderWidth: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            color: '#1a4d4d',
                            font: {
                                size: 13,
                                weight: 'bold',
                                family: "'Segoe UI', system-ui, sans-serif"
                            },
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1a4d4d',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 13,
                            weight: '600'
                        },
                        borderColor: '#7a9b85',
                        borderWidth: 2,
                        padding: 15,
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed;
                            }
                        }
                    }
                }
            }
        });
    }
});
