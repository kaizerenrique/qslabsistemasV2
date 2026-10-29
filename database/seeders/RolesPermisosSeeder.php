<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permisos = [
            // catálogo maestro (Qslab)
            'catalogo.ver', 'catalogo.crear', 'catalogo.editar', 'catalogo.eliminar',
            'solicitudes.revisar',

            // laboratorios (Qslab)
            'laboratorios.ver', 'laboratorios.crear', 'laboratorios.editar',
            'laboratorios.verificar', 'laboratorios.revocar_token',

            // pagos y reembolsos (Qslab)
            'pagos.conciliar', 'reembolsos.gestionar',

            // panel del lab
            'lab.perfil.editar', 'lab.pruebas.gestionar',
            'lab.pedidos.ver', 'lab.pedidos.rechazar',
            'lab.citas.gestionar', 'lab.flebotomistas.gestionar',
            'lab.resultados.subir',

            // paciente
            'paciente.pedidos.ver', 'paciente.resultados.ver',

            // flebotomista
            'flebo.citas.ver', 'flebo.citas.actualizar',
        ];

        foreach ($permisos as $p) {
            Permission::firstOrCreate(['name' => $p, 'guard_name' => 'web']);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'SuperAdmin', 'guard_name' => 'web']);
        $superAdmin->syncPermissions(Permission::all());

        $adminLab = Role::firstOrCreate(['name' => 'AdminLaboratorio', 'guard_name' => 'web']);
        $adminLab->syncPermissions([
            'lab.perfil.editar', 'lab.pruebas.gestionar',
            'lab.pedidos.ver', 'lab.pedidos.rechazar',
            'lab.citas.gestionar', 'lab.flebotomistas.gestionar',
            'lab.resultados.subir',
        ]);

        $operadorLab = Role::firstOrCreate(['name' => 'OperadorLaboratorio', 'guard_name' => 'web']);
        $operadorLab->syncPermissions([
            'lab.pedidos.ver', 'lab.citas.gestionar', 'lab.resultados.subir',
        ]);

        $flebotomista = Role::firstOrCreate(['name' => 'Flebotomista', 'guard_name' => 'web']);
        $flebotomista->syncPermissions([
            'flebo.citas.ver', 'flebo.citas.actualizar',
        ]);

        $paciente = Role::firstOrCreate(['name' => 'Paciente', 'guard_name' => 'web']);
        $paciente->syncPermissions([
            'paciente.pedidos.ver', 'paciente.resultados.ver',
        ]);
    }
}
