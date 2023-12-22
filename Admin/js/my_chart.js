var ctx = document.getElementById('myChart').getContext('2d');
var administered = document.getElementById('administered').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'polarArea',
    data: {
        labels: ['BCG', 'HepB', 'DTap', 'HiB', 'iPV', 'PCV', 'RV', 'Influenza', 'MMR', 'MenB', 'Vericella', 'HepA', 'HPV'],
        datasets: [{
            label: 'Vaccine Stocks by Type',
            data: [120, 190, 300, 250, 280, 321, 243, 213, 311, 222, 156, 214, 311],
            backgroundColor: [
                '#F0EA22',
                '#FFCB0E',
                '#F79020',
                '#F26324',
                '#ED2227',
                '#EA1D64',
                '#C21B79',
                '#613191',
                '#263A94',
                '#1C60AD',
                '#10A1C5',
                '#24AF4B',
                '#89C541'
            ],
        }]
    },
    options: {
        responsive: true,
    }
});

var myChart = new Chart(administered, {
    type: 'bar',
    data: {
        labels: ['BCG', 'HepB', 'DTap', 'HiB', 'iPV', 'PCV', 'RV', 'Influenza', 'MMR', 'MenB', 'Vericella', 'HepA', 'HPV'],
        datasets: [{
            label: 'Administered Vaccine',
            data: [120, 190, 300, 250, 280, 321, 243, 213, 311, 222, 156, 214, 311],
            backgroundColor: [
                '#F0EA22',
                '#FFCB0E',
                '#F79020',
                '#F26324',
                '#ED2227',
                '#EA1D64',
                '#C21B79',
                '#613191',
                '#263A94',
                '#1C60AD',
                '#10A1C5',
                '#24AF4B',
                '#89C541'
            ],
        }]
    },
    options: {
        responsive: true,
    }
});
