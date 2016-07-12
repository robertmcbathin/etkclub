    <div class="container-fluid" id="join-container">
      <div class="container">
      <div class="row">
      <div class="col-md-6 col-md-offset-3">
       <h1>Вступить в клуб</h1>
       <p>Чтобы стать участником программы "ЕТК-Клуб", заполните следующие поля</p><hr>
        @if (count($errors) > 0)
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>
      <hr>
      @endif
       <form action="{{ route('signup') }}" method="post" id="join-form">
       <div class="card-credentials">
         <p>Данные о карте</p>
          <div class="input-group {{ $errors->has('card_serie') ? 'has-error' : ''}}">
            <label for="card_serie" >Серия</label>
            <input type="text" id="card_serie" name="card_serie" maxlength="3" class="form-control" size="3" placeholder="00">
         </div>
         <div class="input-group {{ $errors->has('card_number') ? 'has-error' : ''}}">
            <label for="card_number">Номер</label>
            <input type="text" id="card_number" name="card_number" maxlength="15" class="form-control" size="15" placeholder="000000000">
         </div>
         <span></span>
         <hr>
       </div>
       <div class="owner-credentials">
         <p>Данные о владельце</p>
          <div class="input-group {{ $errors->has('card_number') ? 'has-error' : ''}}">
            <label for="second_name">Фамилия</label>
            <input type="text" id="second_name" name="second_name" maxlength="50" class="form-control" size="50" placeholder="Швецов">
         </div>
         <div class="input-group {{ $errors->has('card_number') ? 'has-error' : ''}}">
            <label for="first_name">Имя</label>
            <input type="text" id="first_name" name="first_name" maxlength="50" class="form-control" size="50" placeholder="Лев">
         </div>
         <div class="input-group {{ $errors->has('card_number') ? 'has-error' : ''}}">
            <label for="third_name">Отчество</label>
            <input type="text" id="third_name" name="third_name" maxlength="50" class="form-control" size="50" placeholder="Александрович">
         </div>
       </div>
       <div class="owner-private-data">
         <div class="input-group {{ $errors->has('card_number') ? 'has-error' : ''}}">
            <label for="sex">Пол</label>
            <select class="form-control" name="sex">
             <option>Не указано</option>
             <option>муж</option>
             <option>жен</option>
            </select>
         </div>
         <div class="input-group {{ $errors->has('card_number') ? 'has-error' : ''}}">
            <label for="dob">Дата рождения</label>
            <input type="date" id="dob" name="dob" maxlength="10" class="form-control" size="10" placeholder="мм/дд/гггг">
         </div>
         <hr>
       </div>
       <div class="owner-private-data">
       <p>Контактные данные</p>
         <div class="input-group {{ $errors->has('card_number') ? 'has-error' : ''}}">
            <label for="phone">Телефон</label>
            <input type="text" id="phone" name="phone" maxlength="10" class="form-control" size="10" placeholder="88007006050">
         </div>
         <div class="input-group {{ $errors->has('card_number') ? 'has-error' : ''}}">
            <label for="dob">Электронная почта</label>
            <input type="email" id="email" name="email" maxlength="50" class="form-control" size="50" placeholder="example@mail.com">
         </div>
         <hr>
       </div>
         <div class="input-group {{ $errors->has('card_number') ? 'has-error' : ''}}">
         <label for="">
           <input type="checkbox" name="confirm"  id="check" checked="checked" value="Y">
           Я ознакомлен(а) с <a href="{{ route('privacy') }}"" target="_blank">политикой конфиденциальности</a> и даю своё <a href="{{ route('eula') }}" target="_blank">согласие на обработку персональных данных</a>.
         </label>
         </div>
         {{ csrf_field() }}
         <button id="submit" type="submit" class="btn btn-primary r-lign">Вступить в клуб</button>
        </form>
        </div>
        </div>
        <div class="row">
                  <hr>
        <p>У Вас еще нет карты? С условиями приобретения Вы можете ознакомиться на сайте <a href="http://etk21.ru" target="_blank">ООО "Единая транспортная карта"</a>.</p>
        </div>
      </div>
    </div>
