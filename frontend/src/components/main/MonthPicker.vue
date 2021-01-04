<template>
  <div id="wrap-months-picker">
    <ul ref="months_picker" id="months-picker" v-dragable>
      <li
        class="item"
        v-for="(i, j) in months"
        :key="j"
        :data-month="i"
        :index="j"
      >
        <span>{{ i }}</span>
      </li>
    </ul>
  </div>
</template>
<script>
import Picker from "./../../utils/pickker";

export default {
  name: "MonthPicker",
  props: ["propsMonth"],
  data() {
    return {
      initialCoordinateX: 0,
      totalWidth: 386,
      itemWidth: 32,
    };
  },
  mounted() {
    this.initialMouseXCalc();
  },
  computed: {
    months() {
      let months = [];
      let j = 0;
      for (let i = 0; i < 12; i++) {
        if (this.propsMonth.startFiscalMonth + i > 12) {
          j += 1;
          months.push(j);
        } else {
          months.push(this.propsMonth.startFiscalMonth + i);
        }
      }

      return months;
    },
  },
  methods: {
    initialMouseXCalc() {
      let initialCoordinate = this.$refs.months_picker.getBoundingClientRect();
      this.initialCoordinateX = initialCoordinate.x;
      this.totalWidth = this.$refs.months_picker.offsetWidth;
      this.itemWidth = Math.floor(this.totalWidth / 12);
    },
  },
  directives: {
    dragable: {
      bind: function (el, binding, vnode) {
        /*init*/
        const _ = Picker;

        let _startMonth = vnode.context.propsMonth.startMonth;
        let _endMonth = vnode.context.propsMonth.endMonth;
        _.setInitActive(el, _startMonth, _endMonth);

        /*press down*/
        el.addEventListener(
          "mousedown",
          function (e) {
            _.isDrawing = true;
            var dx = e.clientX - vnode.context.initialCoordinateX;
            var _position = Math.floor(dx / vnode.context.itemWidth);
            _.setInitMousedown(el, _position);
            _.initialMouseX = e.clientX;

            el.addEventListener("mousemove", handleMousemove, false);
            el.addEventListener("mouseup", handleMouseup, false);
          },
          false
        );

        const handleMousemove = function (e) {
          if (!_.isDrawing) {
            handleMouseup();
            return false;
          }

          let dx = Math.abs(e.clientX) - _.initialMouseX;
          if (dx < 0) {
            dx = dx + vnode.context.itemWidth / 2;
          }
          let i = Math.floor(dx / vnode.context.itemWidth);
          _.posEnd = _.posStart + i;

          _.setActiveWhenMousemove(el, _.posStart, _.posEnd);
        };

        const handleMouseup = function () {
          _.isDrawing = false;
          el.removeEventListener("mousedown", handleMouseup, false);
          el.removeEventListener("mousemove", handleMousemove, false);
          el.removeEventListener("mouseup", handleMouseup, false);
          vnode.context.$emit("fiscal-month", {
            startMonth: _.start,
            endMonth: _.end,
          });
          return false;
        };
      },
    },
  },
};
</script>

<style lang="css">
#wrap-months-picker {
  display: block;
  position: relative;
  margin-bottom: 16px;
  width: 386px;
  border: 1px solid #a3b9c1;
}

#wrap-months-picker:after,
#wrap-months-picker ul#months-picker:after {
  content: "";
  clear: both;
  display: table;
}

#wrap-months-picker ul#months-picker {
  list-style-type: none;
  height: auto;
  width: 100%;
  display: block;
  float: left;
  padding: 0;
  margin: 0;
  overflow: hidden;
}

#wrap-months-picker ul#months-picker li {
  display: block;
  width: 32px;
  height: 32px;
  float: left;
  overflow: hidden;
  background: #ffffff;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  cursor: pointer;
}

#wrap-months-picker ul#months-picker li:not(:first-child) {
  border-left: 1px solid #a3b9c1;
}

#wrap-months-picker ul#months-picker li.active {
  background-color: #4b7b6e;
  color: #ffffff;
}

#wrap-months-picker ul#months-picker li.active span {
  color: #ffffff;
}

#wrap-months-picker ul#months-picker li span {
  display: block;
  cursor: pointer;
  height: 100%;
  line-height: 32px;
  text-align: center;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
</style>