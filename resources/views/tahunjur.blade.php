
            <div class="card mb-3">
                <div class="card-header">
                  <div class="row">
                    <div class="col" align="left">
                      <p><h6>Daftar Jumlah Mahasiswa Per jurusan</h6></p>
                    </div>
                    <div class="col" align="right">
                      <a  href="{{route ('tahunjur.excel')}}" class="btn btn-success">Export to Excel</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {!! Form::open(['url' => 'tahunjur','class' => 'tahunjur']) !!}
                    <div class="row">
                      <div class="col form-group">
                          {!! Form::selectYear('year', 2008, 2017,null,['class' => 'form-control','placeholder'=>'Pilih Tahun ...']) !!}
                      </div>
                      <div class="col form-group">
                        {!! Form::select('semester', ['1' => 'Semester 1', '2' => 'Semester 2'],null,['class' => 'form-control','placeholder'=>'Pilih Semester ...'])!!}
                      </div>
                      <div class="col form-group">
                          {!! Form::select('jurusan',$jurusan,null,['class' => 'form-control','placeholder'=>'Pilih Jurusan ...'])!!}
                      </div>
                      <div class="col form-group">
                        {!! Form::submit('Click Me!',array('class' => 'btn btn-primary'))!!}
                      </div>
                    </div>
                    {!! Form::close() !!}

                    <?php
                      if(isset($_POST['year'],$_POST['semester'],$_POST['jurusan'])){
                        $year=$_POST['year'];
                        $semester=$_POST['semester'];
                        $prodi=$_POST['jurusan'];
                    ?>

                    <table class="table">
                      <tr>
                        <th>Tahun-Semester</th>
                        <th>Jurusan</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                      </tr>
                      <tr>
                          <td>{{$year}}-{{$semester}}</td>
                          <td>{{$jurusan[$prodi]}}</td>
                          <td>{{$query[0]->jumlah}}</td>
                          <td></td>
                      </tr>
                    </table>
                    <?php  }?>

                </div>
            </div>
