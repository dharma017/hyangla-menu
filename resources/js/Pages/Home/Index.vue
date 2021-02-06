<template>
  <div>
    <show-marketing-modal
      :show="showModal(menu.id)"
      :image="menu.marketing_image"
      @close="toggleModal(menu.id)"
    />
    <img class="object-contain w-full" v-if="menu.image" :src="menu.image" />
  </div>
</template>

<script>
import ShowMarketingModal from "../Menus/MarketingImageModal.vue";

export default {
  metaInfo: { title: "Hyangla Menu" },
  components: {
    ShowMarketingModal,
  },
  props: {
    menu: Object,
  },
  data() {
    return {
      activeModal: 0,
    };
  },
  created() {
    if (this.menu.enable_marketing) {
      this.toggleModal(this.menu.id);
    }
  },
  destroyed() {
    console.log("Component has been destroyed!");
  },
  methods: {
    showModal: function (id) {
      return this.activeModal === id;
    },
    toggleModal: function (id) {
      if (this.activeModal !== 0) {
        this.activeModal = 0;
        return false;
      }
      this.activeModal = id;
    },
  },
};
</script>
