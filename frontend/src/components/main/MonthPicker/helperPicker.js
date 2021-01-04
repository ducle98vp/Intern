const Picker = {
  options: {
    initialMouseX: 0,
    isDrawing: false,
    posStart: 0,
    posEnd: 0,
    start: 0,
    end: 0,
    length: 12,
    quaterOfYear: false
  }
};

Picker.addActive = function (item) {
  item.classList.add('active');
};

Picker.removeActive = function (item) {
  item.classList.remove('active');
};

Picker.removeAllActive = function (items) {
  let _this = this;
  for (let i = 0; i < items.length; i++) {
    _this.removeActive(items[i])
  }
}

Picker.setInitActive = function (elm, sm, em) {
  let _this = this;
  let items = elm.children;
  _this.findFirstPosition(items, sm, em);
  for (let i = 0; i < items.length; i++) {
    if (_this.options.posStart <= i && i <= _this.options.posEnd) {
      _this.addActive(items[i])
    } else {
      _this.removeActive(items[i])
    }
  }
}

Picker.findFirstPosition = function (items, m, n) {
  let _this = this;
  for (let i = 0; i < items.length; i++) {
    if (parseInt(items[i].getAttribute('data-month')) === _this.getQuarter(m)) {
      _this.options.posStart = i;
    }
    if (parseInt(items[i].getAttribute('data-month')) === _this.getQuarter(n)) {
      _this.options.posEnd = i;
    }
  }
}

Picker.getQuarter = function (month) {
  return this.options.quaterOfYear ? Math.ceil(month / 3) : month;
}

Picker.specifyStartMonthOfQuater = function (month) {
  switch (parseInt(month)) {
    case 1:
      return 1;
    case 2:
      return 4;
    case 3:
      return 7;
    case 4:
      return 10;
  }
}
Picker.specifyEndMonthOfQuater = function (month) {
  switch (parseInt(month)) {
    case 1:
      return 3;
    case 2:
      return 6;
    case 3:
      return 9;
    case 4:
      return 12;
  }
}

Picker.setInitMousedown = function (elm, i) {
  let _this = this;
  if (i > _this.options.length) i = _this.options.length;
  if (i < 0) i = 0;

  let items = elm.children;
  _this.removeAllActive(items);
  _this.addActive(items[i]);
  _this.options.posStart = i;
  _this.options.posEnd = i;
  _this.options.start = !_this.options.quaterOfYear
    ? items[i].getAttribute('data-month')
    : _this.specifyStartMonthOfQuater(items[i].getAttribute('data-month'));
  _this.options.end = !_this.options.quaterOfYear
    ? items[i].getAttribute('data-month')
    : _this.specifyEndMonthOfQuater(items[i].getAttribute('data-month'));
}

Picker.setActiveWhenMousemove = function (elm, i, j) {
  let _this = this;
  if (i > _this.options.length) i = _this.options.length;
  if (i < 0) i = 0;
  if (j < 0) j = 0;
  if (j > _this.options.length) j = _this.options.length;
  let _start, _end;
  let items = elm.children;
  if (i > j) {
    _start = j;
    _end = i;
  } else {
    _start = i;
    _end = j;
  }
  for (let k = 0; k < items.length; k++) {
    if (_start <= k && k <= _end) {
      _this.addActive(items[k]);
    } else {
      _this.removeActive(items[k]);
    }
  }
  _this.options.posStart = i;
  _this.options.posEnd = j;
  _this.options.start = !_this.options.quaterOfYear
    ? items[_start].getAttribute('data-month')
    : _this.specifyStartMonthOfQuater(items[_start].getAttribute('data-month'));
  _this.options.end = !_this.options.quaterOfYear
    ? items[_end].getAttribute('data-month')
    : _this.specifyEndMonthOfQuater(items[_end].getAttribute('data-month'));
}

Picker.init = function (props) {
  let _this = this;
  _this.options.start = props.startMonth;
  _this.options.end = props.endMonth;
  _this.options.quaterOfYear = props.quaterOfYear;
  _this.options.length = props.quaterOfYear ? 3 : 11;
}

export default Picker;