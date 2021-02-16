<template>
  <div>
    <organization-modal
      :show="showOrganizationModal(organization.id)"
      :image="organization.marketing_image"
      @close="toggleOrganizationModal(organization.id)"
    />
    <img
      class="object-contain w-full"
      v-if="organization.image"
      :src="organization.image"
    />
  </div>
</template>

<script>
import OrganizationModal from "../Organizations/MarketingImageModal.vue";

export default {
  metaInfo: { title: "Hyangla Menu" },
  components: {
    OrganizationModal,
  },
  props: {
    organization: Object,
  },
  data() {
    return {
      activeOrganizationModal: 0,
    };
  },
  created() {
    if (this.organization.enable_marketing) {
      this.toggleOrganizationModal(this.organization.id);
    }
  },
  destroyed() {
    console.log("Component has been destroyed!");
  },
  methods: {
    showOrganizationModal: function (id) {
      return this.activeOrganizationModal === id;
    },
    toggleOrganizationModal: function (id) {
      if (this.activeOrganizationModal !== 0) {
        this.activeOrganizationModal = 0;
        return false;
      }
      this.activeOrganizationModal = id;
    },
  },
};
</script>