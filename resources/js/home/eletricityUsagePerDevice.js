let dataDevices = [{
    values: values,
    labels: labels,
    type: "pie"
}];

let layout = {
    title: "Uso de Eletricidade por Eletrônico",
    displaylogo: false
};

let config = {
    responsive: true,
    displaylogo: false,
    displayModeBar: false
};

Plotly.newPlot("eletricityUsagePerDevice", dataDevices, layout, config);