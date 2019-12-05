<template>
  <div>
    <div
      class="modal fade"
      id="form-info"
      tabindex="-1"
      role="dialog"
      aria-labelledby="scrollableForm"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title text-primary" id="scrollableForm">
              <strong>
                <i v-if="form.is_approved" class="text-primary fas fa-check fa-lg mr-1"></i>
                フォーム詳細
              </strong>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5 class="text-dark mb-3">顧客情報</h5>
            <div class="row mb-3">
              <div class="col-md-4 text-md-right border-right">
                <strong class="text-muted">名前</strong>
              </div>
              <div class="col-md-8">{{ form.name }}</div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4 text-md-right border-right">
                <strong class="text-muted">ふりがな</strong>
              </div>
              <div class="col-md-8">{{ form.furigana }}</div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4 text-md-right border-right">
                <strong class="text-muted">メールアドレス</strong>
              </div>
              <div class="col-md-8">{{ form.email }}</div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4 text-md-right border-right">
                <strong class="text-muted">電話番号</strong>
              </div>
              <div class="col-md-8">{{ form.phone }}</div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4 text-md-right border-right">
                <strong class="text-muted">性別</strong>
              </div>
              <div class="col-md-8">{{ form.gender ? '女' : '男' }}</div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4 text-md-right border-right">
                <strong class="text-muted">生年月日</strong>
              </div>
              <div class="col-md-8">{{ form.birthday }}</div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4 text-md-right border-right">
                <strong class="text-muted">住所</strong>
              </div>
              <div class="col-md-8">{{ form.address }}</div>
            </div>
            <hr />
            <h5 class="text-dark mb-3">予約情報</h5>

            <div v-if="form.type_id > 1" class="row mb-3">
              <div class="col-md-4 text-md-right border-right">
                <strong class="text-muted">使用人数</strong>
              </div>
              <div class="col-md-8">{{ form.user_count }}</div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4 text-md-right border-right">
                <strong class="text-primary">使用理由</strong>
              </div>
              <div class="col-md-8">{{ form.reason }}</div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4 text-md-right border-right">
                <strong class="text-primary">使用日・時間</strong>
              </div>
              <div class="col-md-8"></div>
            </div>
            <div class="pb-3">
              <div v-for="(currDate, index) in formDates" :key="index">
                <div class="row mb-3">
                    <strong class="col-md-4 text-md-right border-right text-muted">{{ index + 1 }}</strong>
                    <strong class="col-md-3 text-center border-right px-0">
                        {{ currDate.sDate }}
                    </strong>
                    <strong class="col-auto pr-0">
                        {{ `${currDate.sHour}:${currDate.sMinute} ~ ${currDate.eHour}:${currDate.eMinute}` }}
                    </strong>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              v-if="user.is_admin && !form.is_approved"
              type="button"
              class="btn-trans text-secondary"
              data-dismiss="modal"
              data-toggle="modal"
              data-target="#confirmFormModal"
            >
              <h5>
                <strong>承認する</strong>
              </h5>
            </button>
            <button type="button" class="btn-trans text-muted" data-dismiss="modal">
              <h5>
                <strong>閉める</strong>
              </h5>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="confirmFormModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="confirmFormModalTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-admin" id="confirmFormModal">
              <strong>確認</strong>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-muted">この予約フォームを承認するつもりですか？</div>
          <div class="modal-footer">
            <button
              @click="approveForm"
              type="button"
              class="btn-trans text-secondary"
              data-dismiss="modal"
            >
              <strong>はい</strong>
            </button>
            <button type="button" class="btn-trans text-dark" data-dismiss="modal">
              <strong>いいえ</strong>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    form: {
      type: Object,
      required: true
    },
    user: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      formDates: []
    };
  },
  methods: {
    arrangeDates(newDates) {
      let currDates = [];

      newDates.forEach(date => {
        const startDate = new Date(date.start_time["raw"]);
        const endDate = new Date(date.end_time["raw"]);

        currDates.push({
          sDate: `${startDate.getFullYear()}-${startDate.getMonth()}-${startDate.getDate()}`,
          sHour: `${
            (startDate.getHours() + "").length == 1 ? "0" : ""
          }${startDate.getHours()}`,
          sMinute: `${
            (startDate.getMinutes() + "").length == 1 ? "0" : ""
          }${startDate.getMinutes()}`,
          eDate: `${endDate.getFullYear()}-${endDate.getMonth()}-${endDate.getDate()}`,
          eHour: `${
            (endDate.getHours() + "").length == 1 ? "0" : ""
          }${endDate.getHours()}`,
          eMinute: `${
            (endDate.getMinutes() + "").length == 1 ? "0" : ""
          }${endDate.getMinutes()}`
        });
      });

      this.formDates = currDates;
    },
    approveForm() {
      axios.patch(`/forms/${this.form.id}/approve`).then(response => {
        if (response.data) {
          notifyUser("予約は承認されました！");
          this.$emit("onFormApproval", response.data);
        } else notifyUser("エラーがあります。");
      });
    }
  },
  watch: {
    form: {
      immediate: true,
      handler(newForm, oldForm) {
        axios.get(`/forms/${newForm.id}/dates`).then(response => {
          this.arrangeDates(response.data);
        });
      }
    }
  }
};
</script>
