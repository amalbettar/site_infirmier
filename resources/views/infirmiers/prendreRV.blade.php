<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
   <h1>
    Rendez-vous avec
    {{ $infirmier->user->nom }}
</h1>

<table class="table table-bordered text-center">

    <thead class="table-dark">

        <tr>

            <th>Jour</th>

            <th>Heure début</th>

            <th>Heure fin</th>

            <th>Action</th>

        </tr>

    </thead>

    <tbody>

        @foreach($disponibilites as $dispo)

            <tr>

                <td>
                    {{ \Carbon\Carbon::parse($dispo->jour)->translatedFormat('l d/m/Y') }}
                </td>

                <td>
                    {{ $dispo->heure_debut }}
                </td>

                <td>
                    {{ $dispo->heure_fin }}
                </td>

                <td>

                    <form
                        action="{{ route('rendezvous.store') }}"
                        method="POST"
                    >

                        @csrf

                        <input
                            type="hidden"
                            name="disponibilite_id"
                            value="{{ $dispo->id }}"
                        >

                        <button class="btn btn-success">

                            Confirmer rendez-vous

                        </button>

                    </form>

                </td>

            </tr>

        @endforeach

    </tbody>

</table>
</body>

</html>