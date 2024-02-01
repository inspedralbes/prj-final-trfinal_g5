import Link from "next/link";

export default function Login() {
  return (
    <div className="flex flex-col items-center justify-center h-screen bg-orange-500">
      <div className="mb-6">
        <img src="/logo_fithub.png" alt="FitHub Logo" width={300} height={300} />
      </div>
      {/* Formulario de inicio de sesión */}
      <form className="bg-white shadow-md rounded-lg border border-black px-8 pt-6 pb-8 mb-10 ">
        <div className="mb-4">
          <label className="block text-gray-700 text-lg font-bold mb-2" htmlFor="username">
            Usuari:
          </label>
          <input
            className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline border-gray-300"
            id="username"
            type="text"
            placeholder="Usuari"
          />
        </div>
        <div className="mb-6">
          <label className="block text-gray-700 text-lg font-bold mb-2" htmlFor="password">
            Contrasenya:
          </label>
          <input
            className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline border-gray-300"
            id="password"
            type="password"
            placeholder="Contrasenya"
          />
          {/* <p className="text-red-500 text-xs italic">Por favor, introduce tu contraseña.</p> */}
          {/* <a
            className="inline-block align-baseline font-bold text-sm text-black hover:text-blue-800"
            href="#"
          >
            <span className="text-xs">Has oblidat la contrasenya?</span>
          </a> */}
        </div>
        <div className="flex items-center justify-between">
          <Link href="/home">
            <button
              className="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
              type="button"
            >
              Iniciar sesió
            </button>
          </Link>
        </div>
        <div className="mt-2">
          <Link href="/registre">
            <button
              className="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
              type="button"
            >
              Registrar-se
            </button>
          </Link>
        </div>
      </form>
    </div>
  );
}
