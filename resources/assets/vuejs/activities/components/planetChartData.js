export const planetChartData = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                35, 30, 35
            ],
            backgroundColor: [
                '#ff0',
                '#f00',
                '#f0f'
            ]
        }],
        labels: [
            'Angular',
            'CSS',
            'HTML'
        ]
    },
    options: {
        cutoutPercentage: 75,
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            display: false,
            position: 'top',
        },
        title: {
            display: false,
            text: 'Technology'
        },
        animation: {
            animateScale: true,
            animateRotate: true
        },
        tooltips: {
            enabled: true,
            intersect: false,
            mode: 'nearest',
            bodySpacing: 5,
            yPadding: 10,
            xPadding: 10,
            caretPadding: 0,
            displayColors: false,
            backgroundColor: '#646c9a',
            titleFontColor: '#ffffff',
            cornerRadius: 4,
            footerSpacing: 0,
            titleSpacing: 0
        }
    }
}

export default planetChartData;