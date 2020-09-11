<template>
    <b-form @submit.prevent="onSubmit" enctype="multipart/form-data">
      
      <div class="image-container mb-4 overflow-hidden rounded">
        <img id="image-preview" :src="previewSrc" :alt="previewSrc" width="100%" height="100%">
      </div>

      <b-form-group
        id="input-group-1"
        label="Tag name:"
        label-for="input-1"
        description="Add a custom tag to identify the part of the image"
      >
        <b-form-input
          id="input-1"
          v-model="form.name"
          type="text"
          required
          placeholder="Describe the custom tag"
        ></b-form-input>
      </b-form-group>

      <b-button type="submit" variant="primary">Submit tag</b-button>
    </b-form>
</template>

<script>
import axios from 'axios'

export default {
    name: 'form-tag',
    props: {
        previewSrc: {
            type: String
        }
    },
    data() {
        return {
            form: {
                name: '',
                image: ''
            }
        }
    },
    methods: {

        onSubmit() {
            this.form.image = this.previewSrc

            let path = this.dataURLtoFile(this.previewSrc, `${this.form.name}.png`)

            const formData = new FormData()
            formData.append('path', path, path.filename)

            axios.post('api/medias', formData)
                .then(res => {
                    console.log(res)
                    this.$router.push({ name: 'home' })
                })
                .catch(err => console.log(err))
        },

        dataURLtoFile(dataUrl, filename) {
            let arr = dataUrl.split(','), mime = arr[0].match(/:(.*?);/)[1],
                bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n)
            
            while(n--){
                u8arr[n] = bstr.charCodeAt(n)
            }
            return new File([u8arr], filename, { type: 'image/png' })
        }
    }
}
</script>

<style lang="css" scoped>
    .image-container {
        width: 100px;
        height: 100px;
        background: gray;
    }
</style>