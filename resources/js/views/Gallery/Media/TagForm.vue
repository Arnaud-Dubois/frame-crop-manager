<template>
    <b-form @submit.prevent="onSubmit" enctype="multipart/form-data">
      
        <!-- Image preview -->
        <h6>Preview cropped selection</h6>
        <div style="background: #DDD" class="d-flex justify-center mb-4 rounded">
        <div class="image-container bg-light overflow-hidden rounded">
            <img id="image-preview" :src="previewSrc" :alt="previewSrc" width="100%" height="100%">
        </div>
        </div>

      
        <!-- Coordinates -->
        <h6 class="mt-4">Image coordinates</h6>
        <div class="row my-3">
            <div class="col-6">
                <pre>width: {{ coordinates.width }}</pre>
                <pre>height: {{ coordinates.height }}</pre>
            </div>
            <div class="col-6">
                <pre>left: {{ coordinates.left }}</pre>
                <pre>top: {{ coordinates.top }}</pre>
            </div>
        </div>
        <!-- / Coordinates -->

        <hr>

        <!-- Tag form -->
        <h6 class="mt-4">Create a custom tag</h6>
        <b-form-group
        id="input-group-1"
        
        label-for="input-1"
        description="Add a custom tag to identify the part of the image"
        >
        <b-form-input
            id="input-1"
            v-model="form.name"
            type="text"
            required
            placeholder="Face, hair, color..."
        ></b-form-input>
        </b-form-group>

      <b-button class="float-right" type="submit" variant="primary">Create</b-button>
    </b-form>
</template>

<script>
import MediasService from '@/services/Medias'

export default {
    name: 'form-tag',
    props: {
        previewSrc: {
            type: String
        },
        coordinates: {
            type: Object
        },
        uploadedFile: {
            type: null
        }
    },
    data() {
        return {
            form: {
                name: '',
                image: '',
                originalImage: 'https://images.pexels.com/photos/226746/pexels-photo-226746.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260',
                coordinates: {}
            }
        }
    },
    methods: {

        onSubmit() {
            this.form.image = this.previewSrc
            this.form.coordinates = this.coordinates

            let path = this.dataURLtoFile(this.previewSrc, `${this.form.name}.png`)

            const formData = new FormData()

            // Set path
            formData.append('path', path, path.filename)

            // Set coordinates
            formData.append('width', this.form.coordinates.width)
            formData.append('height', this.form.coordinates.height)
            formData.append('left', this.form.coordinates.left)
            formData.append('top', this.form.coordinates.top)

            // Get original image
            formData.append('original_image', this.uploadedFile)
            
            MediasService.post(formData)
                .then(res => {
                    this.$bvToast.toast(`${path.name} created successfully.`, {
                        title: `New tag created !`,
                        variant: 'success',
                        solid: true
                    }).then(() => {
                        this.$router.push({ name: 'home' })
                    })
                })
                .catch(err => {
                    console.log(err.response)
                    this.$bvToast.toast(err.response.data.message, {
                        title: `Error !`,
                        variant: 'danger',
                        solid: true
                    })
                })
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
    }
</style>