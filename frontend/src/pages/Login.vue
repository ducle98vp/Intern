<template>
  <div class="login-box">
    <div class="login-logo">
      <router-link to="/">
        <b>Ketoan9</b> Management
      </router-link>
    </div>
    <!-- /.login-logo -->
    <Loading/>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Đăng nhập</p>

        <form v-on:submit.prevent="logIn">
          <div class="">
            <label>Email</label>
          </div>
          <div class="input-group mb-3">
            <input
              type="email"
              ref="email"
              class="form-control"
              placeholder="Email"
              v-model="loginData.email"
            >
            <div class="input-group-append">
              <span class="fas fa-envelope input-group-text"></span>
            </div>
          </div>
          <div class="title-password">
            <label>Mật khẩu</label>
            <router-link to="/reset_password" class="text-forgot-password">Quên mật khẩu ?</router-link>
          </div>
          <div class="input-group mb-3">
            <input
              type="password"
              ref="password"
              class="form-control"
              placeholder="Mật khẩu"
              v-model="loginData.password"
            >
            <div class="input-group-append">
              <span class="fas fa-lock input-group-text"></span>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Ghi nhớ cho lần sau
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
            </div>
            <!-- /.col -->
          </div>

          <div class="social-auth-links text-center mb-3">
            <button
              type="submit"
              class="btn btn-primary btn-block btn-flat"
            >Đăng nhập</button>
          </div>
        </form>
        <!-- /.social-auth-links -->
        <p class="mb-1">Bạn chưa có tài khoản? <router-link to="/register" class="text-center">Hãy đăng ký tại đây !</router-link></p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
</template>


<script>
import auth from "./../controllers/auth.controller";
import Loading from "./../components/main/Loading";
export default {
  components: {
    Loading,
  },
  name: "Login",
  data: function() {
    return {
      loginData: {
        email: '',
        password: ''
      },
    };
  },
  methods: {
    logIn: async function() {
      await auth.logIn(this.loginData);
    }
  },
  created: function() {
    document.body.classList.add("login-page");
  },
  destroyed: function() {
    document.body.classList.remove("login-page");
  }
};
</script>

<style scoped>
.text-forgot-password {
  position: absolute;
  right: 0;
  color:#007BFF;
}
.title-password {
  position: relative;
}
</style>
