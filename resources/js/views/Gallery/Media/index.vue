<template>
    <div class="min-vh-100">
        <BackButton/>

        <div class="d-block d-md-flex flex-row-reverse">
            
            <div class="w-100 my-3 my-md-0">
                <h2 class="mt-0">
                    Tag {{ item.id }} datas
                </h2>
                <hr>
                
                <h6>Tags</h6>
                <div class="row my-3">
                    <div class="col">
                        <span class="badge badge-primary badge-text-size font-weight-normal">
                            <Tag class="d-inline"/> {{ item.name }}
                        </span>
                    </div>
                </div>
                
                <h6>Coordinates</h6>
                <div class="row my-3">
                    <div class="col-6 col-md-3">
                        <div>width: {{item.width}}</div>
                        <div>height: {{item.height}}</div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div>left: {{item.left}}</div>
                        <div>top: {{item.top}}</div>
                    </div>
                </div>
            </div>
            <img class="media-cover-image rounded mr-4" :src="item.path" :alt="item.path" width="256" height="256">
        </div>

        <!-- Original image -->
        <template v-if="item.original_image">
            <h4 class="mt-5">Original image</h4>
            <div class="row">
                <div class="col">
                    <img
                        class="w-100 rounded"
                        :src="`storage/original_images/${item.original_image}`"
                        :alt="item.original_image"
                    >
                </div>
            </div>
        </template>
        <!-- / Original image -->

    </div>
</template>

<script>
import BackButton from '@/components/BackButton'
import MediasService from '@/services/Medias'
export default {
    name: 'media',
    data() {
        return {
            item: {}
        }
    },
    components: {
        BackButton
    },
    mounted() {
        this.fetchItem()    
    },
    methods: {
        fetchItem() {
            MediasService.get(this.$route.params.mediaId)
                .then(res => {
                    this.item = res.data
                })
                .catch(err => console.log(err))
        }
    }
}
</script>

<style lang="css">
    .media-cover-image {
        width: 256px;
        height: 256px;
    }
    .badge-text-size {
        font-size: 1.2rem;
    }

</style>