const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"ignition.healthCheck":{"uri":"_ignition\/health-check","methods":["GET","HEAD"]},"ignition.executeSolution":{"uri":"_ignition\/execute-solution","methods":["POST"]},"ignition.updateConfig":{"uri":"_ignition\/update-config","methods":["POST"]},"api.createDevice":{"uri":"api\/device","methods":["POST"]},"api.getDevices":{"uri":"api\/device","methods":["GET","HEAD"]},"api.getDevice":{"uri":"api\/device\/{id}","methods":["GET","HEAD"],"parameters":["id"]},"api.updateDevice":{"uri":"api\/device\/{id}","methods":["PUT"],"parameters":["id"]},"home":{"uri":"\/","methods":["GET","HEAD"]},"eletronicos":{"uri":"eletronicos","methods":["GET","HEAD"]},"logout":{"uri":"logout","methods":["GET","HEAD"]},"contato":{"uri":"contato","methods":["GET","HEAD"]},"sobre":{"uri":"sobre","methods":["GET","HEAD"]},"register":{"uri":"register","methods":["GET","HEAD"]},"registerAction":{"uri":"register","methods":["POST"]},"login":{"uri":"login","methods":["GET","HEAD"]},"loginAction":{"uri":"login","methods":["POST"]},"dashboard":{"uri":"dashboard","methods":["GET","HEAD"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
