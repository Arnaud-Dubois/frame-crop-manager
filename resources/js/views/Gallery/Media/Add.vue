<template>
    <div class="container-fluid">

      <BackButton/>

      <header class="text-left">
        <h1>Frame selector tool</h1>
        <div class="row mt-3 mb-4">
          <div class="col-12 col-md-5">
            <p>Pick an image from your computer, select a fragment of the image with the <b>crop tool</b> and add a custom tag to it.</p>
          </div>
        </div>
      </header>

      <!-- Tools -->
        <h6>Pick an image from your computer</h6>
        <div class="d-flex mb-4 mb-md-2">
          
          <b-form-file
            v-model="uploadedFile"
            @input="uploadFile"
            :state="Boolean(uploadedFile)"
            placeholder="Choose a file or drop it here..."
            drop-placeholder="Drop file here..."
          ></b-form-file>

        </div>
      <!-- / Tools -->
      
      <div class="row">
        
        <!-- Base image -->
        <div class="col-12 col-md-8">

            <button
              style="z-index: 1"
              class="btn btn-primary mt-2 mr-4 shadow position-absolute right-0"
              @click="crop"
            >
              <Crop class="d-inline"/> Crop
            </button>
          
          <Cropper
            class="cropper rounded"
            ref="cropper"
            :src="originalImage ? originalImage : 'https://images.pexels.com/photos/226746/pexels-photo-226746.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260'"
            :stencil-props="{
              aspectRatio: 10/10
            }"
            @change="change"
          ></Cropper>
          
        </div>
        <!-- / Base image -->

        <!-- Custom tag form -->
        <div class="col">
          <b-card class="text-left">
            <TagForm
              :previewSrc="croppedImage"
              :uploadedFile="uploadedFile"
              :coordinates="coordinates"
            />
          </b-card>
        </div>
        <!-- / Custom tag form -->

      </div>
    </div>
</template>

<script>
import BackButton from '@/components/BackButton'
import { Cropper } from 'vue-advanced-cropper'
import TagForm from './TagForm'

export default {
    name: 'media-add',
    components: {
        BackButton,
        Cropper,
        TagForm
    },
    data() {
        return {
          coordinates: {
              width: 0,
              height: 0,
              left: 0,
              top: 0
          },
          croppedImage: null,
          uploadedFile: null,
          originalImage: null
        }
    },
    methods: {

      crop() {
        const { coordinates, canvas } = this.$refs.cropper.getResult()
        this.coordinates = coordinates
        this.croppedImage = canvas.toDataURL()
      },

      change({coordinates, canvas}) {
        this.coordinates = coordinates
      },

      uploadFile() {
        this.toBase64(this.uploadedFile)
      },

      toBase64(file) {
        const reader = new FileReader()
        reader.readAsDataURL(file)
        reader.onload = () => {
          this.originalImage = reader.result
        }
      },

      getDataUrl(image) {
        const canvas = document.createElement('canvas')
        const ctx = canvas.getContext('2d')

        canvas.width = image.width
        canvas.height = image.height

        ctx.drawImage(image, 0, 0)
        return canvas.toDataURL('image/jpeg')
      }

	}
}
</script>

<style>
    .cropper {
        height: 600px;
        background: #DDD;
    }
</style>