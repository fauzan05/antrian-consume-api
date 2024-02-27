import Chart from 'chart.js/auto';
import { months } from './utils';
const chart1 = document.getElementById('myChart1');
const chart2 = document.getElementById('myChart2');
const chart3 = document.getElementById('myChart3');
const pieChart = document.getElementById('pieChart');
const polarChart = document.getElementById('polarChart');
const labels = months({count: 7});

const data1 = {
  labels: labels,
  datasets: [{
    label: 'My First Dataset',
    data: [65, 59, 80, 81, 56, 55, 40],
    fill: false,
    borderColor: 'rgb(75, 192, 192)',
    tension: 0.1
  }]
}
const dataDummy = {
  labels: labels,
  datasets: [{
    label: 'My First Dataset',
    data: [65],
    fill: false,
    borderColor: 'rgb(75, 192, 192)',
    tension: 0.1
  }]
}



const data2 = {
  labels: [
    'Red',
    'Blue',
    'Yellow'
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [300, 50, 100],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)'
    ],
    hoverOffset: 4
  }]
}

const data3 = {
  labels: [
    'Red',
    'Green',
    'Yellow',
    'Grey',
    'Blue'
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [11, 16, 7, 3, 14],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(75, 192, 192)',
      'rgb(255, 205, 86)',
      'rgb(201, 203, 207)',
      'rgb(54, 162, 235)'
    ]
  }]
}


  new Chart(chart1, {
    type: 'line',
    data: dataDummy
  });
  new Chart(chart2, {
    type: 'line',
    data: data1
  });
  new Chart(chart3, {
    type: 'line',
    data: data1
  });
  new Chart(pieChart, {
    type: 'doughnut',
    data: data2 
  });
  new Chart(polarChart, {
    type: 'polarArea',
    data: data3,
    options: {
      padding: 0,
    }
  });