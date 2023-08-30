<x-layout >
    <x-alerts.success />
    <div class="container">
        <div>
            <h2>
                User List
            </h2>
        </div>
        <x-tables.listTable :tableHead='["ID", "Name", "Email", "Role"]' :datas='$userData'/>
    </div>
</x-layout>