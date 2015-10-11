@extends('app')

@section('content')

<div id="guestbook" class="col-md-8">
        <form method="POST" v-on="submit: onSubmitForm">

            <div class="form-group">
                <label for="name">
                    昵称:
                    <span class="error" v-if="! newMessage.name">*</span>
                </label>
                <input type="text" name="name" id="name" class="form-control" v-model="newMessage.name">
            </div>

            <div class="form-group">
                <label for="message">
                    请输入您的留言:
                    <span class="error" v-if="! newMessage.message">*</span>
                </label>
                <textarea type="text" name="message" id="message" class="form-control" v-model="newMessage.message"></textarea>
            </div>

            <div class="form-group" v-if="! submitted">
                <button type="submit" class="btn btn-primary"v-attr="disabled: errors">
                提交
                </button>
                <i>&nbsp;&nbsp;好去处网诚邀请热心网友给我们的网站提修改意见和建议，以求进一步改进网站。</i>
            </div>

            <div class="alert alert-success" v-if="submitted">Thanks!</div>

        </form>

        <script type="text/x-template" id="grid-template">
          <div  class="guestbook">
          <table>
            <thead>
              <tr>
                <th v-repeat="key: columns"
                  v-on="click:sortBy(key)"
                  v-class="active: sortKey == key">
                  @{{key | capitalize}}
                  <span class="arrow"
                    v-class="reversed[key] ? 'dsc' : 'asc'">
                  </span>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-repeat="
                entry: data
                | filterBy filterKey
                | orderBy sortKey reversed[sortKey]">
                <td v-repeat="key: columns">
                  @{{entry[key]}}
                </td>
              </tr>
            </tbody>
          </table>
          </div>
        </script>

        <!-- demo root element -->

        <form id="search" class="inner-addon right-addon">
            <input name="query" v-model="searchQuery" class="form-control" placeholder='搜索留言板上任何关键字'><i class="glyphicon glyphicon-search"></i>
        </form>
        <demo-grid
            data="@{{messages}}"
            columns="@{{gridColumns}}"
            filter-key="@{{searchQuery}}">
        </demo-grid>
</div>
@include('sidebar')
@stop