<template>
  <div></div>
</template>

<script>
import Dropdown from "@/Shared/Dropdown";
import FlashMessages from "@/Shared/FlashMessages";
import Icon from "@/Shared/Icon";
import Logo from "@/Shared/Logo";
import MainMenu from "@/Shared/MainMenu";

export default {
  components: {
    Dropdown,
    FlashMessages,
    Icon,
    Logo,
    MainMenu,
  },
  data() {
    return {
      showUserMenu: false,
      accounts: null,
    };
  },
  methods: {
    url() {
      return location.pathname.substr(1);
    },
    hideDropdownMenus() {
      this.showUserMenu = false;
    },
  },
};
</script>
