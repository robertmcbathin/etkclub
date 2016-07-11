    <div class="container-fluid" id="join-container">
      <div class="container">
      <div class="row">
      <div class="col-md-6 col-md-offset-3">
       <h1>Вступить в клуб</h1>
       <p>Чтобы стать участником программы "ЕТК-Клуб", заполните следующие поля</p><hr>
       <form action="{{ route('signup') }}" method="post" id="join-form">
       <div class="card-credentials">
         <p>Данные о карте</p>
          <div class="input-group">
            <label for="card_serie" >Серия</label>
            <input type="text" id="card_serie" name="card_serie" maxlength="3" class="form-control" size="3">
         </div>
         <div class="input-group">
            <label for="card_number">Номер</label>
            <input type="text" id="card_number" name="card_number" maxlength="15" class="form-control" size="15">
         </div>
         <hr>
       </div>
       <div class="owner-credentials">
         <p>Данные о владельце</p>
          <div class="input-group">
            <label for="second_name">Фамилия</label>
            <input type="text" id="second_name" name="second_name" maxlength="50" class="form-control" size="50">
         </div>
         <div class="input-group">
            <label for="first_name">Имя</label>
            <input type="text" id="first_name" name="first_name" maxlength="50" class="form-control" size="50">
         </div>
         <div class="input-group">
            <label for="third_name">Отчество</label>
            <input type="text" id="third_name" name="third_name" maxlength="50" class="form-control" size="50">
         </div>
       </div>
       <div class="owner-private-data">
         <div class="input-group">
            <label for="sex">Пол</label>
            <input type="text" id="sex" name="sex" maxlength="3" class="form-control" size="3">
         </div>
         <div class="input-group">
            <label for="dob">Дата рождения</label>
            <input type="date" id="dob" name="dob" maxlength="10" class="form-control" size="10">
         </div>
         <hr>
       </div>
       <div class="owner-private-data">
       <p>Контактные данные</p>
         <div class="input-group">
            <label for="phone">Телефон</label>
            <input type="text" id="phone" name="phone" maxlength="10" class="form-control" size="10" placeholder="88007006050">
         </div>
         <div class="input-group">
            <label for="dob">Электронная почта</label>
            <input type="email" id="email" name="email" maxlength="50" class="form-control" size="50" placeholder="example@mail.com">
         </div>
         <hr>
       </div>
         <div class="input-group">
         <label for="">
           <input type="checkbox" name="confirm"   checked="checked" value="Y">
           Я ознакомлен(а) с <a href="{{ route('privacy') }}"" target="_blank">политикой конфиденциальности</a> и даю своё <a href="{{ route('eula') }}" target="_blank">согласие на обработку персональных данных</a>.
         </label>
         </div>
         {{ csrf_field() }}
         <button type="submit" class="btn btn-primary r-lign">Вступить в клуб</button>
        </form>
        </div>
        </div>
      </div>
    </div>
