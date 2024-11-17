import { Header } from "../../components/layout/Header"
import { Profile } from "../../components/layout/Profile"
import { SideBar } from "../../components/layout/SideBar"
import { Task } from "../../components/task/Task"

export const Tasks = () => {
  return (
    <div className="flex">
      <SideBar />
      <div className="flex-1">
        <Header />
        <div className="ml-16 w-[85%] p-3">
          <h1 className="text-2xl font-semibold">Your Tasks</h1>
          <div className="flex gap-4 mt-5 flex-wrap">
            <Task />
            <Task />
            <Task />
            <Task />
            <Task />
            <Task />
          </div>
        </div>
      </div>
      <Profile />
    </div>
  )
}
