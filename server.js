const WebSocket = require('ws');

const wss = new WebSocket.Server({ port: 8080 });


const customers = new Map();
const admins = new Map();

wss.on('connection', function connection(ws) {
  ws.on('message', function incoming(message) {
    const data = JSON.parse(message);
    if (data.type === 'customer') {
      customers.set(data.id, ws);
    } else if (data.type === 'admin') {
      admins.set(data.id, ws);
    }
    handleMessage(data);
  });

  ws.on('close', function close() {
    
  });
});

function handleMessage(message) {
  if (message.type === 'customer') {
    
    admins.forEach((admin) => {
      admin.send(JSON.stringify(message));
    });
  } else if (message.type === 'admin') {
  
    const customer = customers.get(message.to);
    if (customer) {
      customer.send(JSON.stringify(message));
    }
  }
}
