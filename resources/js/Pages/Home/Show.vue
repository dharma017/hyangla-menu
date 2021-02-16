<template>
  <div>
    <menu-modal
      :show="showMenuModal(menu.id)"
      :image="menu.marketing_image"
      @close="toggleMenuModal(menu.id)"
    />
    <organization-modal
      :show="showOrganizationModal(organization.id)"
      :image="organization.marketing_image"
      @close="toggleOrganizationModal(organization.id)"
    />
    <img class="object-contain w-full" v-if="menu.image" :src="menu.image" />
  </div>
</template>

<script>
import MenuModal from "@/Pages/Menus/MarketingImageModal.vue";
import OrganizationModal from "@/Pages/Organizations/MarketingImageModal.vue";

export default {
  metaInfo: { title: "Hyangla Menu" },
  components: {
    MenuModal,
    OrganizationModal,
  },
  props: {
    menu: Object,
    organization: Object,
  },
  data() {
    return {
      activeMenuModal: 0,
      activeOrganizationModal: 0,
    };
  },
  created() {
    if (this.organization.enable_marketing) {
      this.toggleOrganizationModal(this.organization.id);
    } else {
      if (this.menu.enable_marketing) {
        this.toggleMenuModal(this.menu.id);
      }
    }
  },
  destroyed() {
    console.log("Component has been destroyed!");
  },
  methods: {
    showMenuModal: function (id) {
      return this.activeMenuModal === id;
    },
    toggleMenuModal: function (id) {
      if (this.activeMenuModal !== 0) {
        this.activeMenuModal = 0;
        return false;
      }
      this.activeMenuModal = id;
    },
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