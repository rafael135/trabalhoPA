let trace = {
    x: x,
    y: y,
    type: "scatter"
};

let data = [trace];

let layoutEletricityUsage = {
    title: "Uso de Eletricidade Mensal"
};

let configEletricityUsage = {
    responsive: true,
    displaylogo: false,
    displayModeBar: false
}

Plotly.newPlot("eletricityUsageGraph", data, layoutEletricityUsage, configEletricityUsage);