import { http } from './config';

export default {
    index: () => {
        return http.get('operadoras')
    },
    store: (operadora) => {
        return http.post('operadoras', operadora)
    },
    update: (operadora) => {
        return http.put('operadoras/'+operadora.id, operadora)
    },
    destroy: (id) => {
        return http.delete('operadoras/' + id)
    },
}