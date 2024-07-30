const config = require('./config.json');
const axios = require('axios');
const cron = require('node-cron');

const apiUrl = config.connection.api.scheme + '://' + config.connection.api.hostname + '/' + config.connection.api.url;
const endpoint = config.connection.endpoint.scheme + '://' + config.connection.endpoint.hostname + '/' + config.connection.endpoint.url;

const sendToEndpoint = async (data) => {
    try {
        await axios.post(endpoint, data);
    } catch (error) {
        console.error('Error sending data: ', error.message);
    }
};

const fetchAndSendData = async () => {
    try {
        const response = await axios.get(apiUrl, {
            headers: {
                "Authorization" : `Bearer ${config.connection.api.token}`
            }
        })
        const data = response.data;

        if (!Array.isArray(data)) {
            throw new Error('Expected an array of objects');
        }

        const promises = data.map(item => sendToEndpoint(item));

        await Promise.all(promises);
    } catch (error) {
        console.error('Error fetching data: ', error.message);
    }
};

cron.schedule('* * * * *', () => {
    console.log('Running nodejs vehicle sync');
    fetchAndSendData();
});