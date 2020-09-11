<template>
    <div class="container-fluid">
      <header class="text-left">
        <h1>Frame selector</h1>
        <p>Draw a frame in the image and add a custom tag to it.</p>
      </header>
      
      <!-- Row -->
      <div class="row">
        
        <!-- Base image -->
        <div class="col-12 col-md-8">
          <Cropper
            class="cropper rounded"
            ref="cropper"
            :src="'https://images.pexels.com/photos/226746/pexels-photo-226746.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260'"
            :stencil-props="{
              aspectRatio: 10/10
            }"
          ></Cropper>
          <button
            class="btn btn-dark mt-3 mb-4 mb-md-0"
            @click="crop"
          >
            Select this frame
          </button>
        </div>
        <!-- / Base image -->

        <!-- Custom tag form -->
        <div class="col">
          <h2 class="text-left">Add a custom label to the selected frame</h2>
          <b-card class="text-left">
            <TagForm :previewSrc="image"/>
          </b-card>
        </div>
        <!-- / Custom tag form -->

      </div>
      <!-- / Row -->

    </div>
</template>

<script>
import { Cropper } from 'vue-advanced-cropper'
import TagForm from './TagForm'

export default {
    name: 'media-add',
    components: {
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
        image: null
        }
    },
    methods: {
        crop() {
          const { coordinates, canvas } = this.$refs.cropper.getResult()
          this.coordinates = coordinates
          this.image = canvas.toDataURL()
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