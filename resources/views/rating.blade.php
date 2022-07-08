@extends('layouts.app')
@extends('layouts.upcomming_c')

@section('title') LeaderBoard @endsection

@section('content')
<script>document.getElementById('rating').style.color = "#3498db";</script>

<style>
.page_title {
    font-weight: 600;
    font-size: 28px;
    color: #333;
    padding-left: 20px;
}
</style>
<div id="users" style ="border: 1px solid #f1f1f1; border-radius: 5px; width: 95%; margin: auto; background-color: white;" class="p-2">
    <div class="d-flex justify-content-between" style=" margin-bottom: 12px;">
        <div class="d-flex" style=" margin-left: 10%;">
            <label style=" font-size: 17px;
                    font-weight: 600;
                    font-size: 22px;
                    color: #333;
                    margin-top: 5px;
                    padding-left: 10px;">Leader Board</label>
                <span style=" margin-top: 11px; padding-left: 10px;"> - Users</span>
        </div>
        <ul class="d-flex" style="width: 20%; margin-top: 12px;">
            <li>
                <a class="anchor p-2" ><strong>{{ __('Users') }}</strong></a>
            </li>

            <li style="margin-left: 10px">
                <a class="anchor p-2" onclick="teams();">{{ __('Teams') }}</a>
            </li>
        </ul>
    </div>
    <table class="table table-borderless datatable table-hover table-sm" style="font-size: 14px; width: 95%; margin: auto; text-align: center">
        <thead>
          <tr style="background-color: #f1f4f9;">
            <th style="min-width: 20px; font-size: 17px; width: 5%" scope="col">#</th>
            <th class="pr-5" style="width: 40%; text-align: left;" scope="col">User</th>
            <th class="pr-5" style="width: 30%;" scope="col">Country</th>
            <th class="pr-5" style="width: 60px;" scope="col">Rating</th>
          </tr>
        </thead>
        <tbody>

        <?php $i = 1;?>

        {{-- feach country flag --}}
        @foreach ($users as $user)
            <?php $country_logo = ''; ?>
            @foreach ($countries as $country)
                @if ($country->country_name == $user->country)
                    <?php $country_logo = $country->flag; ?>
                @endif
            @endforeach

          <tr>
            <th>{{$i}}</th> <?php $i++; ?>
            <td style=" text-align: left;">{{ $user->username }}</td>
            <td>
                @if ($user->country != '')
                    <img src="../../image/country/{{$country_logo}}" style="width: 30px; margin-right: 15px;">{{ $user->country }}
                @endif
            </td>
            <td>{{ $user->rating }}</td>
          </tr>
          {{-- @if ($i==10)
              @break
          @endif --}}
        @endforeach
        @if ($i == 1)
            <tr style="text-align: center;"><td class="not-found" colspan="7"><h6>No User Found</h6></td></tr>
        @endif
        </tbody>
        <tfoot>
            <tr>
              <td colspan="4" class=" pagination-nav">
                  {{ $users->onEachSide(1)->links()}}
              </td>
            </tr>
        </tfoot>
      </table>
</div>

{{-- ////////**************** TEAM **************\\\\\\\\\ --}}
<div id="teams" style ="border: 1px solid #f1f1f1; border-radius: 5px; width: 95%; margin: auto; background-color: #fff; display: none;" class="p-2">
    <div class="d-flex justify-content-between" style=" margin-bottom: 12px;">
        <div class="d-flex" style=" margin-left: 10%;">
                <label style=" font-size: 17px;
                        font-weight: 600;
                        font-size: 22px;
                        color: #333;
                        margin-top: 5px;
                        padding-left: 10px;">Leader Board</label>
                    <span style=" margin-top: 11px; padding-left: 10px;"> - Teams</span>
            </div>
        <ul class="d-flex" style="width: 20%; margin-top: 12px;">
        <li>
                <a class="anchor p-2" onclick="users();">{{ __('Users') }}</a>
            </li>

            <li style="margin-left: 10px">
                <a class="anchor p-2" ><strong>{{ __('Teams') }}</strong></a>
            </li>
        </ul>
    </div>
    <table class="table table-borderless datatable table-hover table-sm" style="font-size: 14px; width: 95%; margin: auto; text-align: center">
        <thead>
          <tr style="background-color: #f1f4f9;">
            <th style="min-width: 20px; font-size: 17px; width: 5%" scope="col">#</th>
            <th class="pr-5" style="width: 40%; text-align: left;" scope="col">User</th>
            <th class="pr-5" style="width: 30%;" scope="col">Organization</th>
            <th class="pr-5" style="width: 60px;" scope="col">Rating</th>
          </tr>
        </thead>
        <tbody>

        <?php $i = 1;?>

        {{-- feach organization logo --}}
        @foreach ($teams as $team)
        <?php $org_logo = ''; ?>
        @foreach ($organizations as $org)
            @if ($org->name == $team->organization)
                <?php $org_logo = $org->logo; ?>
                @break
            @endif
        @endforeach

          <tr>
            <th>{{$i}}</th> <?php $i++; ?>
            <td style=" text-align: left;">{{ $team->username }}</td>
            <td><img src="../../image/organization/{{$org_logo}}" style="width: 30px; margin-right: 15px;">{{ $team->organization }}</td>
            <td>{{ $team->rating }}</td>
          </tr>
          {{-- @if ($i==10)
              @break
          @endif --}}
        @endforeach

        @if ($i == 1)
            <tr style="text-align: center;"><td class="not-found" colspan="7"><h6>No Team Found</h6></td></tr>
        @endif

        </tbody>
        <tfoot>
            <tr>
              <td colspan="4" class=" pagination-nav">
                  {{ $teams->onEachSide(1)->links()}}
              </td>
            </tr>
        </tfoot>
      </table>
</div>

@endsection

<script>
function users(){
    document.getElementById('teams').style.display = "none";
    document.getElementById('users').style.display = "block";
}
function teams(){
    document.getElementById('users').style.display = "none";
    document.getElementById('teams').style.display = "block";
}
</script>
