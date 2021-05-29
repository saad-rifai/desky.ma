<template>
    <div>
        <canvas id="myChart" width="400" height="175"></canvas>
    </div>
</template>
<script>


    

export default {
    methods:{
        draw: function(){
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['يناير', 'فبراير', 'مارس', 'ابريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر',
                    'نوفمبر', 'ديسمبر'
                ],
                datasets: [{
                        label: 'المبيعات الشهرية',
                        data: [0, 5680, 6841, 6012, 9874, 6501, 10587, 12054, 11471, 11874, 12478, 13567],
                                    fill: true,

                        backgroundColor: [
                            '#f78b034a'
    
                        ],
                        borderColor: [
                            'rgba(247, 139, 3, 1)'
                        ],
                        borderWidth: 2
                    },

                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
   }
    }
   ,
   mounted: function(){
       this.draw();
   }
}
</script>