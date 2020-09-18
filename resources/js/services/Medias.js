import axios from 'axios'

const url = 'api/medias'

class MediasService {

    // Get medias
    static getAll() {
        return axios.get(url)
    }

    // Show media
    static get(id) {
        return axios.get(`${url}/${id}`)
    }

    // Store media
    static post(formData) {
        return axios.post(url, formData)
    }

    // Delete media
    static delete(id) {
        return axios.delete(`${url}/${id}`)
    }

}

export default MediasService