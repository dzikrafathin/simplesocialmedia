import axios from 'axios'

const baseDomain = 'http://localhost:8000';
const baseURL = `${baseDomain}/api`
const token = localStorage.getItem('token');

const Client = axios.create({
    baseURL : baseURL
});

if (token) {
    Client.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}

export default Client;